<?php

namespace App\Http\ViewComposers;

use App\Post;
use App\Setting;
use App\Category;
use Illuminate\View\View;

class HeaderFooterComposer
{
    public $popularPosts = [];
    public $lastModifiedPosts = [];
    public $categories = [];
    public $trendingPost = null;

    /**
     * Create a composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->popularPosts = Post::where('post_status', 'publish')->orderByViews()->take(3)->get();
        $this->lastModifiedPosts = Post::select('photo_id','slug')
            ->where('post_status', 'publish')
            ->orderBy('updated_at', 'desc')
            ->take(9)
            ->get();
        $this->categories = Category::where('id', '!=',  1)->get();

        $this->trendingPost = Post::where('post_status', 'publish')->orderByViews()->first();

        $this->settings = [];

        $this->settings['linkedinUrl'] = Setting::where('meta_key', 'linkedin_url')->value('meta_value');
        $this->settings['gplusUrl'] = Setting::where('meta_key', 'gplus_url')->value('meta_value');
        $this->settings['twitterUrl'] = Setting::where('meta_key', 'twitter_url')->value('meta_value');
        $this->settings['facebookUrl'] = Setting::where('meta_key', 'facebook_url')->value('meta_value');
        $this->settings['aboutInfo'] = Setting::where('meta_key', 'about_info')->value('meta_value');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function footerCompose(View $view)
    {
        $view->with([
            'popularPosts' => $this->popularPosts,
            'lastModifiedPosts' => $this->lastModifiedPosts, 
            'categories' => $this->categories,
            'settings' => $this->settings
        ]);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function headerCompose(View $view)
    {
        $view->with([
            'trendingPost' => $this->trendingPost,
            'categories' => $this->categories,
            'settings' => $this->settings
        ]);
    }
}