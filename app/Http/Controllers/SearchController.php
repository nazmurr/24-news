<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $posts = Post::where('post_status', 'publish')
            ->where(function($query) use($request) {
                $query->where('title','LIKE','%'.$request->q.'%')
                ->orWhere('content','LIKE','%'.$request->q.'%');
            })
            ->paginate(10);

        $popularPosts = Post::where('post_status', 'publish')->orderByViews()->take(4)->get();

        return view('search')
            ->withPosts($posts)
            ->withQuery($request->q)
            ->withPopularPosts($popularPosts)
            ->withMessage( !count($posts) ? 'Nothing found. Try to search again!' : '' );
    }
}
