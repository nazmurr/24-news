<div class="container-fluid pb-4 pt-5">
    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Related News</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider2">
            @foreach ($relatedPosts as $post)
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img">
                            <a href="{{ url('posts/'.$post->slug) }}">
                                <img src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']) : url('images/no-img.jpg') }}" alt=""/>
                            </a>
                        </div>
                        <div>
                            <a href="{{ url('posts/'.$post->slug) }}" class="d-block fh5co_small_post_heading"><span class="">{{ $post->title }}</span></a>
                            <div class="c_g"><i class="fa fa-clock-o"></i> {{ $post->created_at->format('M d Y') }}</div>
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
    </div>
</div>