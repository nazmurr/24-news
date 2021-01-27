<div class="container-fluid fh5co_header_bg">
    <div class="container">
        <div class="row">
            <div class="col-12 fh5co_mediya_center"><span class="color_fff fh5co_mediya_setting"><i
                    class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;{{ $trendingPost->created_at->format('l, j F Y') }}</span>
                <div class="d-inline-block fh5co_trading_posotion_relative"><div class="treding_btn">Trending</div>
                    <div class="fh5co_treding_position_absolute"></div>
                </div>
            <a href="{{ url('posts/'.$trendingPost->slug) }}" class="color_fff fh5co_mediya_setting">{{ $trendingPost->title }}</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 fh5co_padding_menu">
                <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="img" class="fh5co_logo_width"/></a>
            </div>
            <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table search-btn"><div class="fh5co_verticle_middle"><i class="fa fa-search"></i></div></a>
                </div>
                @if ($settings['linkedinUrl'])
                    <div class="text-center d-inline-block">
                        <a href="{{$settings['linkedinUrl']}}" target="_blank" class="fh5co_display_table">
                            <div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div>
                        </a>
                    </div>     
                @endif
                
                @if ($settings['gplusUrl'])
                    <div class="text-center d-inline-block">
                        <a href="{{$settings['gplusUrl']}}" target="_blank" class="fh5co_display_table">
                            <div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div>
                        </a>
                    </div>
                @endif

                @if ($settings['twitterUrl'])
                    <div class="text-center d-inline-block">
                        <a href="{{$settings['twitterUrl']}}" target="_blank" class="fh5co_display_table">
                            <div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div>
                        </a>
                    </div>
                @endif

                @if ($settings['facebookUrl'])
                    <div class="text-center d-inline-block">
                        <a href="{{$settings['facebookUrl']}}" target="_blank" class="fh5co_display_table">
                            <div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div>
                        </a>
                    </div>
                @endif
                
                <!--<div class="d-inline-block text-center"><img src="images/country.png" alt="img" class="fh5co_country_width"/></div>-->
                {{-- <div class="d-inline-block text-center dd_position_relative ">
                    <select class="form-control fh5co_text_select_option">
                        <option>English </option>
                        <option>French </option>
                        <option>German </option>
                        <option>Spanish </option>
                    </select>
                </div> --}}
                <div class="clearfix"></div>
                <form id="header-search-form" action="/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="q"
                            placeholder="Search..."> <span class="input-group-btn">
                            {{-- <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button> --}}
                        </span>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" alt="img" class="mobile_logo_width"/></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @foreach ($categories as $cat)
                        <li class="nav-item {{ request()->routeIs('category') && $cat->id === $category->id ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('categories/'.$cat->slug) }}">{{ $cat->name }} <span class="sr-only">(current)</span></a>
                        </li>    
                    @endforeach
                    <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>