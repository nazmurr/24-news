<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $posts = Post::where('title','LIKE','%'.$request->q.'%')
            ->orWhere('content','LIKE','%'.$request->q.'%')
            ->paginate(10);

        $popularPosts = Post::orderByViews()->take(4)->get();

        return view('search')
            ->withPosts($posts)
            ->withQuery($request->q)
            ->withPopularPosts($popularPosts)
            ->withMessage( !count($posts) ? 'Nothing found. Try to search again!' : '' );
    }
}
