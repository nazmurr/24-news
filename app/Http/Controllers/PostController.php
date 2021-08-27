<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($slugString)
    {
        $post = Post::findBySlugOrFail($slugString);

        views($post)->record();

        $relatedPosts = Post::where([
            ['category_id', $post->category_id],
            ['post_status', 'publish'],
            ['id', '!=', $post->id]    
        ])
        ->orderBy('updated_at', 'DESC')
        ->take(20)->get();
        
        $popularPosts = Post::where([
            ['id', '!=', $post->id], ['post_status', 'publish']
            ])->orderByViews()->take(4)->get();

        $comments = Comment::where('post_id', $post->id)->orderBy('created_at', 'desc')->get();

        return view('posts.single', compact('post', 'relatedPosts', 'popularPosts', 'comments'));
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
