<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminCommentsController extends Controller
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
        $comments = [];
        if (Auth::user()->role->name !== 'administrator') {
            $comments = Comment::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        } else {
            $comments = Comment::orderBy('id', 'desc')->paginate(10);
        }

        return view('admin.comments.index', compact('comments'));
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
        $comment = Comment::find($id);

        if (($comment->user_id !== Auth::user()->id) && (Auth::user()->role->name !== 'administrator')) {
            return redirect('admin/comments');
        }
        
        return view('admin.comments.edit', compact('comment'));
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
        $comment = Comment::findOrFail($id);

        if (($comment->user_id !== Auth::user()->id) && (Auth::user()->role->name !== 'administrator')) {
            return redirect('admin/comments');
        }

        $input = $request->all();

        $comment->update($input);
        Session::flash('flash_admin', 'Comment updated successfully!');
        return redirect('admin/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (($comment->user_id !== Auth::user()->id) && (Auth::user()->role->name !== 'administrator')) {
            return redirect('admin/comments');
        }
        
        $comment->delete();
        
        Session::flash('flash_admin', 'Comment deleted successfully!');
        return redirect('admin/comments');
    }
}
