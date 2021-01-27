<div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
    <div>
        <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Most Popular</div>
    </div>
    @if (count($popularPosts))
        @foreach ($popularPosts as $post)
            <div class="row pb-3">
                <div class="col-5 align-self-center">
                    <a href="{{ url('posts/'.$post->slug) }}">
                        <img 
                            src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']) : url('images/no-img.jpg') }}" 
                            alt="img" 
                            class="fh5co_most_trading"
                        />
                    </a>
                </div>
                <div class="col-7 paddding">
                    <div class="most_fh5co_treding_font"> <a href="{{ url('posts/'.$post->slug) }}">{{ $post->title }}</a></div>
                    <div class="most_fh5co_treding_font_123"> {{ $post->created_at->format('M d Y') }}</div>
                </div>
            </div>
        @endforeach
    @else
            <p>Sorry, no posts found!</p>
    @endif
</div>