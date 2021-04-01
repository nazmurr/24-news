<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $category = Category::findOrFail($id);
    //     $categoryPosts = Post::with('category')->where('category_id', $id)->get();
    //     $popularPosts = Post::orderByViews()->take(4)->get();

    //     return view('categories.single', compact('category', 'categoryPosts', 'popularPosts'));  
    // }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $userPosts = Post::where([
            ['user_id', $user->id], ['post_status', 'publish']
            ])->latest()->paginate(10);
        $popularPosts = Post::orderByViews()->take(4)->get();

        return view('authors.single', compact('user', 'userPosts', 'popularPosts'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
