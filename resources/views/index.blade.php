@extends('layouts.app')
@section('title', "Home")
@section('content')
@if (count($featuredPosts))
    <div class="container-fluid paddding mb-5">
        <div class="row mx-0">
            <div class="col-md-6 col-12 paddding animate-box" data-animate-effect="fadeIn">
                <div class="fh5co_suceefh5co_height"><img src="{{ $featuredPosts[0]->photo_id ? url('uploads/posts/'.$featuredPosts[0]->photo['filename']) : url('images/no-img.jpg') }}" alt="img"/>
                    <div class="fh5co_suceefh5co_height_position_absolute"></div>
                    <div class="fh5co_suceefh5co_height_position_absolute_font">
                        <div class=""> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $featuredPosts[0]->created_at->format('M d Y') }}
                        </div>
                        <div class=""><a href="{{ url('posts/'.$featuredPosts[0]->slug) }}" class="fh5co_good_font"> {{ $featuredPosts[0]->title }} </a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    @foreach ($featuredPosts as $ind => $post)
                        @if ($ind === 0)
                            @continue
                        @endif
                        <div class="col-md-6 col-6 paddding animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co_suceefh5co_height_2"><img src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']) : url('images/no-img.jpg') }}" alt="img"/>
                                <div class="fh5co_suceefh5co_height_position_absolute"></div>
                                <div class="fh5co_suceefh5co_height_position_absolute_font_2">
                                    <div class=""> <i class="fa fa-clock-o"></i>&nbsp;&nbsp; {{ $post->created_at->format('M d Y') }}</div>
                                    <div class=""><a href="{{ url('posts/'.$post->slug) }}" class="fh5co_good_font_2"> {{ $post->title }} </a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
@if (count($trendingPosts))
    <div class="container-fluid pt-3">
        <div class="container animate-box" data-animate-effect="fadeIn">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Trending</div>
            </div>
            <div class="owl-carousel owl-theme js" id="slider1">
                @foreach ($trendingPosts as $post)
                    <div class="item px-2">
                        <a href="{{ url('posts/'.$post->slug) }}">
                            <div class="fh5co_latest_trading_img_position_relative">
                                <div class="fh5co_latest_trading_img">
                                    <img 
                                        src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']) : url('images/no-img.jpg') }}" 
                                        alt="" 
                                        class="fh5co_img_special_relative" 
                                    />
                                </div>
                                <div class="fh5co_latest_trading_img_position_absolute"></div>
                                <div class="fh5co_latest_trading_img_position_absolute_1">
                                    <a href="{{ url('posts/'.$post->slug) }}" class="text-white"> {{ $post->title }} </a>
                                    <div class="fh5co_latest_trading_date_and_name_color"> {{ $post->user['name'] }} - {{ $post->created_at->format('M d Y') }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
<div class="container-fluid pb-4 pt-4 paddding mt-3">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Top News</div>
                </div>
                @if ($topPosts)
                    @foreach ($topPosts as $post)
                        <div class="row pb-4">
                            <div class="col-md-5">
                                <div class="fh5co_hover_news_img">
                                    <div class="fh5co_news_img">
                                        <img src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']) : url('images/no-img.jpg') }}" alt=""/>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="col-md-7 animate-box">
                                <a href="{{ url('posts/'.$post->slug) }}" class="fh5co_magna py-2"> {{ $post->title }} </a> 
                                <div class="py-2">{{ $post->user['name'] }} - {{ $post->created_at->format('M d Y') }} | {{ $post->category['name'] }}</div>
                                <div class="fh5co_consectetur"> {!! Str::words(strip_tags($post->content), 30) !!} </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Sorry, no posts found!</p>
                @endif
            </div>
            @include('includes.sidebar')
        </div>
    </div>
</div>
@endsection