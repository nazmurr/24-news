@extends('layouts.admin')

@section('title', 'All Posts')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Posts    
                    @endcomponent
                    
                    @if(Session::has('flash_admin'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ Session('flash_admin') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if($posts->count())
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
                                        <th>Comments</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
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
                                            <td>{{$post->comments_count}}</td>
                                            <td>{{$post->created_at->diffForHumans()}}</td>
                                            <td>{{$post->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button onClick="window.open('{{url('posts/'.$post->slug)}}', '_blank')" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button>
                                                    <button onClick="window.location='{{url('admin/posts/'.$post->id.'/edit')}}'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <button class="item delete-post" data-post-id="{{$post->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button> 
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrap">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    @else
                        <p>Sorry no posts found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<form method="POST" action="" id="delete-post-form" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@include('admin.includes.modal')

@push('scripts')
<script>

    jQuery(function() {
        jQuery('.delete-post').click(function() {
            const postId = $(this).data('post-id');
            $('#mediumModal #mediumModalLabel').text('Delete Post');
            $('#mediumModal').addClass('delete-post-modal');
            $('#mediumModal .modal-body').html(`Are you sure you want to delete post with id <strong>${postId}</strong>?`);
            $('#mediumModal').modal('show');
        });

        jQuery('body').on('click', '.delete-post-modal .confirm', function() {
            const postId = $('.delete-post-modal .modal-body strong').text();
            $("#delete-post-form").attr('action', '/admin/posts/'+postId);
            $("#delete-post-form").submit();
            $('#mediumModal').modal('hide');
        });
    });
</script>
@endpush

@endsection