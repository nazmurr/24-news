@extends('layouts.app')
@section('class', 'single')
@section('title', $post->title)
@section('content')
<div id="fh5co-title-box" style="background-image: url({{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']): url('images/no-img.jpg') }}); background-position: center;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="page-title">
        @if ($post->user['profile_pic'])
            <img src="{{ url('uploads/users/'.$post->user['profile_pic']) }}" alt="user pic">            
        @endif
        <span style="margin-bottom: 0; text-transform: capitalize;">Published By: <a href="{{ url('/authors/'.$post->user['id']) }}">{{ $post->user['name'] }}</a></span>
        <span style="margin-bottom: 0; text-transform: capitalize;">Published At: {{ $post->created_at->format('M d Y') }}</span>
        <span style="text-transform: capitalize;">Published In: <a href="{{ url('/categories/'.$post->category['slug']) }}">{{ $post->category['name'] }}</a></span>
        <h2>{{ $post->title }}</h2>
    </div>
</div>
<div id="fh5co-single-content" class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                {!!html_entity_decode($post->content)!!}
            </div>
            @include('includes.sidebar')
        </div>
    </div>
</div>

@include('includes.comments')

@if (count($relatedPosts))
    @include('includes.trending')
@endif

@endsection