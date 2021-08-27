@extends('layouts.admin')

@section('title', 'All Comments')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Comments    
                    @endcomponent
                    
                    @if(Session::has('flash_admin'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ Session('flash_admin') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if($comments->count())
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Comment</th>
                                        <th>Post</th>
                                        @if(Auth::user()->role->name == 'administrator')
                                            <th>Author</th>
                                        @endif
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{$comment->id}}</td>
                                            <td><a href="{{url('admin/comments/'.$comment->id.'/edit')}}">{{$comment->comment}}</a></td>
                                            <td><a href="{{url('posts/'.$comment->post->slug)}}">{{$comment->post->title}}</a></td>
                                            @if(Auth::user()->role->name == 'administrator')
                                                <td>{{$comment->user->name}}</td>
                                            @endif
                                            <td>{{$comment->created_at->diffForHumans()}}</td>
                                            <td>{{$comment->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button onClick="window.location='{{url('admin/comments/'.$comment->id.'/edit')}}'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <button class="item delete-comment" data-comment-id="{{$comment->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button> 
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrap">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    @else
                        <p>Sorry no comments found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<form method="POST" action="" id="delete-comment-form" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@include('admin.includes.modal')

@push('scripts')
<script>

    jQuery(function() {
        jQuery('.delete-comment').click(function() {
            const commentId = $(this).data('comment-id');
            $('#mediumModal #mediumModalLabel').text('Delete Comment');
            $('#mediumModal').addClass('delete-comment-modal');
            $('#mediumModal .modal-body').html(`Are you sure you want to delete comment with id <strong>${commentId}</strong>?`);
            $('#mediumModal').modal('show');
        });

        jQuery('body').on('click', '.delete-comment-modal .confirm', function() {
            const commentId = $('.delete-comment-modal .modal-body strong').text();
            $("#delete-comment-form").attr('action', '/admin/comments/'+commentId);
            $("#delete-comment-form").submit();
            $('#mediumModal').modal('hide');
        });
    });
</script>
@endpush

@endsection