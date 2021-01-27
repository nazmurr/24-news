@extends('layouts.admin')

@section('title', 'All Categories')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Categories    
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
                                    <th>Posts Count</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($categories)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->posts_count}}</td>
                                            <td>{{$category->created_at->diffForHumans()}}</td>
                                            <td>{{$category->updated_at->diffForHumans()}}</td>
                                            <td>
                                                @if ($category->id !== 1)
                                                    <div class="table-data-feature">
                                                        <button onClick="window.location='{{url('admin/categories/'.$category->id.'/edit')}}'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item delete-category" data-category-id="{{$category->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button> 
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form method="POST" action="" id="delete-category-form" style="display: none;">
    @csrf
    @method('DELETE')
    {{-- <button type="submit" class="btn btn-secondary">Delete Category</button> --}}
</form>

@include('admin.includes.modal')

@push('scripts')
<script>

    jQuery(function() {
        jQuery('.delete-category').click(function() {
            const categoryId = $(this).data('category-id');
            $('#mediumModal #mediumModalLabel').text('Delete Category');
            $('#mediumModal').addClass('delete-category-modal');
            $('#mediumModal .modal-body').html(`Are you sure you want to delete category with id <strong>${categoryId}</strong>?`);
            $('#mediumModal').modal('show');
        });

        jQuery('body').on('click', '.delete-category-modal .confirm', function() {
            const categoryId = $('.delete-category-modal .modal-body strong').text();
            $("#delete-category-form").attr('action', '/admin/categories/'+categoryId);
            $("#delete-category-form").submit();
            $('#mediumModal').modal('hide');
        });
    });
</script>
@endpush

@endsection