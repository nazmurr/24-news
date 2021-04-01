<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

    public function show($slugString)
    {
        $category = Category::findBySlugOrFail($slugString);
        $categoryPosts = Post::with('category')->where([
            ['category_id', $category->id],
            ['post_status', 'publish']
            ])->latest()->paginate(10);
        $popularPosts = Post::where('post_status', 'publish')->orderByViews()->take(4)->get();

        return view('categories.single', compact('category', 'categoryPosts', 'popularPosts'));  
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
