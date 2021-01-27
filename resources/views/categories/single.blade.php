@extends('layouts.app')
@section('title', $category->name)
@section('content')
<div class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">{{$category->name}}</div>
                </div>
                @if (count($categoryPosts))
                    @foreach ($categoryPosts as $post)
                        <div class="row pb-4">
                            <div class="col-md-5">
                                <div class="fh5co_hover_news_img">
                                    <div class="fh5co_news_img">
                                        <a href="{{ url('posts/'.$post->slug) }}">
                                            <img 
                                                src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']) : url('images/no-img.jpg') }}" 
                                                alt="img" 
                                            />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 animate-box">
                                <a href="{{ url('posts/'.$post->slug) }}" class="fh5co_magna py-2"> {{ $post->title }} </a> 
                                <div class="fh5co_mini_time py-2" style="display: block;"> {{ $post->created_at->format('F d, Y') }} </div>
                                <div class="fh5co_consectetur">{!! Str::words(strip_tags($post->content), 30) !!}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Sorry, no posts found!</p>
                @endif
            </div>
            @include('includes.sidebar')
        </div>
        {{ $categoryPosts->links('includes.pagination') }}
    </div>
</div>
{{-- @include('includes.trending') --}}
@endsection