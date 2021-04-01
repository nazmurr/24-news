@extends('layouts.admin')

@section('title', 'All Users')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Users    
                    @endcomponent
                    
                    @if(Session::has('flash_admin'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ Session('flash_admin') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Active</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role->name}}</td>
                                            <td>{{$user->active == 1 ? 'Yes': 'No'}}</td>
                                            <td>{{$user->created_at->diffForHumans()}}</td>
                                            <td>{{$user->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button onClick="window.open('{{url('authors/'.$user->id)}}', '_blank')" class="item" data-toggle="tooltip" data-placement="top" title="View All Posts">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button>
                                                    <button onClick="window.location='{{url('admin/users/'.$user->id.'/edit')}}'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <button class="item delete-user" data-user-id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button> 
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination-wrap">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form method="POST" action="" id="delete-user-form" style="display: none;">
    @csrf
    @method('DELETE')
    {{-- <button type="submit" class="btn btn-secondary">Delete User</button> --}}
</form>

@include('admin.includes.modal')

@push('scripts')
<script>

    jQuery(function() {
        jQuery('.delete-user').click(function() {
            const userId = $(this).data('user-id');
            $('#mediumModal #mediumModalLabel').text('Delete User');
            $('#mediumModal').addClass('delete-user-modal');
            $('#mediumModal .modal-body').html(`Are you sure you want to delete user with id <strong>${userId}</strong>?`);
            $('#mediumModal').modal('show');
        });

        jQuery('body').on('click', '.delete-user-modal .confirm', function() {
            const userId = $('.delete-user-modal .modal-body strong').text();
            $("#delete-user-form").attr('action', '/admin/users/'+userId);
            $("#delete-user-form").submit();
            $('#mediumModal').modal('hide');
        });
    });
</script>
@endpush

@endsection