<div class="container-fluid fh5co_footer_bg pb-3">
    <div class="container animate-box">
        <div class="row">
            <div class="col-12 spdp_right py-5"><img src="{{ asset('images/white_logo.png') }}" alt="img" class="footer_logo"/></div>
            <div class="clearfix"></div>
            <div class="col-12 col-md-4 col-lg-3">
                @if ($settings['aboutInfo'])
                    <div class="footer_main_title py-3"> About</div>
                    <div class="footer_sub_about pb-3">{{$settings['aboutInfo']}}</div>
                @endif
                <div class="footer_mediya_icon">
                    @if ($settings['linkedinUrl'])
                        <div class="text-center d-inline-block">
                            <a href="{{$settings['linkedinUrl']}}" target="_blank" class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div>
                            </a>
                        </div>
                    @endif
                    @if ($settings['gplusUrl'])
                        <div class="text-center d-inline-block">
                            <a href="{{$settings['gplusUrl']}}" target="_blank" class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div>
                            </a>
                        </div>
                    @endif
                    @if ($settings['twitterUrl'])
                        <div class="text-center d-inline-block">
                            <a href="{{$settings['twitterUrl']}}" target="_blank" class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div>
                            </a>
                        </div>
                    @endif
                    @if ($settings['facebookUrl'])
                        <div class="text-center d-inline-block">
                            <a href="{{$settings['facebookUrl']}}" target="_blank" class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-2">
                <div class="footer_main_title py-3"> Category</div>
                <ul class="footer_menu">
                    @foreach ($categories as $category)
                        <li>
                        <a href="{{ url('/categories/'.$category->slug ) }}" class="">
                                <i class="fa fa-angle-right"></i>&nbsp;&nbsp; {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-5 col-lg-3 position_footer_relative">
                <div class="footer_main_title py-3"> Most Viewed Posts</div>
                @foreach ($popularPosts as $post)
                    <div class="footer_makes_sub_font"> {{ $post->created_at->format('M d Y') }}</div>
                    <a href="{{ url('posts/'.$post->slug) }}" class="footer_post pb-4"> {{ $post->title }} </a>
                @endforeach
                <div class="footer_position_absolute">
                    <img src="{{ url('images/footer_sub_tipik.png') }}" alt="img" class="width_footer_sub_img"/>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 ">
                <div class="footer_main_title py-3"> Last Modified Posts</div>
                @foreach ($lastModifiedPosts as $post)
                    <a href="{{ url('posts/'.$post->slug) }}" class="footer_img_post_6">
                        <img src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']) : url('images/no-img.jpg') }}" alt="img"/>
                    </a>
                @endforeach
            </div>
        </div>
        {{-- <div class="row justify-content-center pt-2 pb-4">
            <div class="col-12 col-md-8 col-lg-7 ">
                <div class="input-group">
                    <span class="input-group-addon fh5co_footer_text_box" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                    <input type="text" class="form-control fh5co_footer_text_box" placeholder="Enter your email..." aria-describedby="basic-addon1">
                    <a href="#" class="input-group-addon fh5co_footer_subcribe" id="basic-addon12"> <i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Subscribe</a>
                </div>
            </div>
        </div> --}}
    </div>
</div>
<div class="container-fluid fh5co_footer_right_reserved">
    <div class="container">
        <div class="row  ">
            <div class="col-12 col-md-6 py-4 Reserved"> &copy; Copyright {{ date('Y') }}, All rights reserved. Created by <a href="https://www.nrwebsoft.com/">Nazmur Rahman</a>. </div>
            <div class="col-12 col-md-6 spdp_right py-4">
            <a href="{{ url('/') }}" class="footer_last_part_menu">Home</a>
                <a href="{{ url('/about') }}" class="footer_last_part_menu">About</a>
                <a href="{{ url('/contact') }}" class="footer_last_part_menu">Contact</a>
        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<!-- Waypoints -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<!-- Main -->
<script src="{{ asset('js/main.js') }}"></script>

</body>