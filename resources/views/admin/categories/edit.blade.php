@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Edit Category    
                    @endcomponent

                    @component('admin.includes.formErrors')
        
                    @endcomponent
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                @if (!empty($category))
                                    <form id="edit-category-form" action="/admin/categories/{{ $category->id }}" method="POST" class="form-horizontal needs-validation" novalidate enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="card-body card-block">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="name" class=" form-control-label">Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="name" name="name" placeholder="Enter Category Name" class="form-control" value="{{ $category->name }}" required>
                                                    <div class="invalid-feedback">Category Name is required</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" class="form-control" name="id" value="{{ $category->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div>Category not found</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')

@endpush

@endsection