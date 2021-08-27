@extends('layouts.admin')

@section('title', 'Home')

@section('content')
@if (Auth::user()->role_id == 1)
    <!-- STATISTIC-->
    <section class="statistic m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="statistic__item">
                            <h2 class="number">{{ $totalUsers }}</h2>
                            <span class="desc">Total Users</span>
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="statistic__item">
                            <h2 class="number">{{ $totalPosts }}</h2>
                            <span class="desc">Total Posts</span>
                            <div class="icon">
                                <i class="zmdi zmdi-file"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->
@endif

<section class="@if (Auth::user()->role_id != 1) statistic m-t-75 @endif">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <h3 class="title-5 m-b-35">Recent Posts</h3>
                    @if($recentPosts->count())
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        @if (Auth::user()->role_id == 1)
                                            <th>Owner</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentPosts as $post)
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td><a href="{{url('admin/posts/'.$post->id.'/edit')}}">{{$post->title}}</a></td>
                                            <td>{{$post->category->name}}</td>
                                            @if (Auth::user()->role_id == 1)
                                                <td>{{$post->user->name}}</td>
                                            @endif
                                            <td style="font-size: 16px;">
                                                @if ($post->post_status === 'publish')
                                                    <span class="badge bg-success text-light">Published</span>
                                                @else
                                                    <span class="badge bg-danger text-light">Pending</span>  
                                                @endif
                                            </td>
                                            <td>{{$post->created_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button onClick="window.open('{{url('posts/'.$post->slug)}}', '_blank')" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button>
                                                    <button onClick="window.location='{{url('admin/posts/'.$post->id.'/edit')}}'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Sorry no posts found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection