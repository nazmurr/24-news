<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use CyrildeWit\EloquentViewable\Support\Period;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popularPosts = Post::where('post_status', 'publish')->orderByViews()->take(4)->get();
        $featuredPosts = Post::where('post_status', 'publish')->orderByViews()->take(5)->get();
        $trendingPosts = Post::where('post_status', 'publish')->orderByViews('desc', Period::pastDays(1))->take(10)->get();
        $catList = Category::pluck('id')->all();
        $topPosts = [];
        foreach ($catList as $catId) {
            $post = Post::where([
                ['category_id', $catId], ['post_status', 'publish']
                ])->latest()->first();
            if ($post !== null) $topPosts[] = $post;
        }          

        return view('index', compact('popularPosts', 'featuredPosts', 'trendingPosts', 'topPosts'));
    }
}
