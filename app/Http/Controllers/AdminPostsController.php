<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Validator;

class AdminPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whereCondition = [];
        $posts = [];
        if (Auth::user()->role->name !== 'administrator') {
            $posts = Post::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(10);
        }

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
       $input = $request->all();
        //$input = $request->except(['featured_img_file']);

        if ($featuredImg = $request->file('featured_img_file')) {
            $rules = [
                'featured_img_file' => 'image|max:2048',
            ];
    
            $validation = Validator::make($request->only('featured_img_file'), $rules);
    
            if ($validation->fails()) {
                return back()->withErrors(['featured_img_file' => $validation->errors()->first()]);
            }

            $md5 = md5(uniqid(rand(), true));
            $name = $md5 . '.' . $featuredImg->getClientOriginalExtension();
            $featuredImg->move('uploads/posts', $name);
            $image = Photo::create(['filename' => $name]);
            $input['photo_id'] = $image->id;
        } else $input['photo_id'] = 0;

        $input['user_id'] = Auth::user()->id;
        Post::create($input);
        Session::flash('flash_admin', 'Post created successfully!');
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (($post->user_id !== Auth::user()->id) && (Auth::user()->role->name !== 'administrator')) {
            return redirect('admin/posts');
        }
        
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (($post->user_id !== Auth::user()->id) && (Auth::user()->role->name !== 'administrator')) {
            return redirect('admin/posts');
        }

        $input = $request->all();

        if ($featuredImg = $request->file('featured_img_file')) {
            $rules = [
                'featured_img_file' => 'image|max:2048',
            ];
    
            $validation = Validator::make($request->only('featured_img_file'), $rules);
    
            if ($validation->fails()) {
                return back()->withErrors(['featured_img_file' => $validation->errors()->first()]);
            }

            $md5 = md5(uniqid(rand(), true));
            $name = $md5 . '.' . $featuredImg->getClientOriginalExtension();
            $featuredImg->move('uploads/posts', $name);
            $image = Photo::create(['filename' => $name]);
            $input['photo_id'] = $image->id;

            if ($post->photo_id) {
                $this->removeImage('uploads/posts/'.$post->photo['filename']);
                Photo::findOrFail($post->photo_id)->delete();
            }
        }

        if ($input['remove_img']) {
            if ($post->photo_id) {
                $this->removeImage('uploads/posts/'.$post->photo['filename']);
                Photo::findOrFail($post->photo_id)->delete();
                $input['photo_id'] = 0;
            }
        }

        $post->update($input);
        Session::flash('flash_admin', 'Post updated successfully!');
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (($post->user_id !== Auth::user()->id) && (Auth::user()->role->name !== 'administrator')) {
            return redirect('admin/posts');
        }
        
        if ($post->photo_id) {
            $this->removeImage('uploads/posts/'.$post->photo['filename']);
            Photo::findOrFail($post->photo_id)->delete();
        }

        $post->delete();
        
        Session::flash('flash_admin', 'Post deleted successfully!');
        return redirect('admin/posts');
    }

    private function removeImage($imagePath)
    {  
        if (File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
            return true;
        } 
        
        return false;
    }
}
