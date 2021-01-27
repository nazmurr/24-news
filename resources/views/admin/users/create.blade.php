@extends('layouts.admin')

@section('title', 'Add User')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Add New User    
                    @endcomponent

                    @component('admin.includes.formErrors')
        
                    @endcomponent
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <form action="/admin/users" method="POST" class="form-horizontal needs-validation" novalidate>
                                    @csrf
                                    <div class="card-body card-block">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="name" class=" form-control-label">Name</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required>
                                                <div class="invalid-feedback">Name is required</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email" class=" form-control-label">Email</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" required>
                                                <div class="invalid-feedback validate-email">Email is required</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="password" class=" form-control-label">Password</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" minlength="4" maxlength="15" required>
                                                <div class="invalid-feedback">Password length min 4 and max 15 characters</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="role_id" class=" form-control-label">Role</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="role_id" id="role_id" class="form-control custom-select" required>
                                                    <option value="">Select a role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Select a role</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="active" class=" form-control-label">Status</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="active" id="active" class="form-control custom-select" required>
                                                    <option value="">Select a status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                <div class="invalid-feedback">Select status</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <input type="hidden" name="profile_pic" value="" />
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection