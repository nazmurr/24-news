<aside class="menu-sidebar2">
    <div class="logo">
        <a href="{{ url('/admin') }}">
            <img src="{{ asset('images/white_logo.png') }}" alt="24 News" style="width: 100px;" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <div class="image img-cir img-120">
                <img 
                    src="{{ Auth::user()->profile_pic 
                    ? url('uploads/users/'.Auth::user()->profile_pic) 
                    : asset('images/admin-default-avatar.png') }}" 
                    alt="{{ Auth::user()->name }}" 
                />
            </div>
            <h4 class="name"><a href="{{url('/admin/users/me')}}">{{ Auth::user()->name }}</a></h4>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="has-sub {{Request::segment(2) == 'posts' ? 'active' : ''}}">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Posts
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('/admin/posts')}}">
                                <i class="fas fa-copy"></i>All Posts</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/posts/create')}}">
                                <i class="fas fa-plus"></i>Add New</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub {{Request::segment(2) == 'comments' ? 'active' : ''}}">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-comments"></i>Comments
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('/admin/comments')}}">
                                <i class="fas fa-comments"></i>All Comments</a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Pages
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="#">
                                <i class="fas fa-copy"></i>All Pages</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-plus"></i>Add New</a>
                        </li>
                    </ul>
                </li> --}}
                @if (Auth::user()->role_id == 1)
                    <li class="has-sub {{Request::segment(2) == 'users' ? 'active' : ''}}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-user"></i>Users
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="{{url('/admin/users')}}">
                                    <i class="fas fa-user"></i>All Users</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/users/create')}}">
                                    <i class="fas fa-plus"></i>Add New</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-sub {{Request::segment(2) == 'categories' ? 'active' : ''}}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tags"></i>Categories
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="{{url('/admin/categories')}}">
                                    <i class="fas fa-tags"></i>All Categories</a>
                            </li>
                            <li>
                                <a href="{{url('/admin/categories/create')}}">
                                    <i class="fas fa-plus"></i>Add New</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{Request::segment(2) == 'settings' ? 'active' : ''}}">
                        <a href="{{url('/admin/settings')}}">
                            <i class="fas fa-cog"></i>Settings</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>