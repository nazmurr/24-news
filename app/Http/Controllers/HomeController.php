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
        $popularPosts = Post::orderByViews()->take(4)->get();
        $featuredPosts = Post::orderByViews()->take(5)->get();
        $trendingPosts = Post::orderByViews('desc', Period::pastDays(1))->take(10)->get();
        $catList = Category::pluck('id')->all();
        $topPosts = [];
        foreach ($catList as $catId) {
            $post = Post::where('category_id', $catId)->latest()->first();
            if ($post !== null) $topPosts[] = $post;
        }          

        return view('index', compact('popularPosts', 'featuredPosts', 'trendingPosts', 'topPosts'));
    }
}
