@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Edit User    
                    @endcomponent

                    @component('admin.includes.formErrors')
        
                    @endcomponent

                    @if(Session::has('flash_admin'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ Session('flash_admin') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                @if (!empty($user))
                                    <form id="edit-user-form" action="/admin/users/{{ isset($roles) ? $user->id : 'update-my-profile' }}" method="POST" class="form-horizontal needs-validation" novalidate enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="card-body card-block">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="name" class=" form-control-label">Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}" required>
                                                    <div class="invalid-feedback">Name is required</div>
                                                </div>
                                                
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email" class=" form-control-label">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    @isset($roles)
                                                        <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}" required>
                                                        <div class="invalid-feedback validate-email">Email is required</div>
                                                    @else
                                                        {{ $user->email }}
                                                    @endisset
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password" class=" form-control-label">Password</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" minlength="4" maxlength="15">
                                                    <div class="invalid-feedback">Password length min 4 and max 15 characters</div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="role_id" class=" form-control-label">Role</label>
                                                </div>
                                                
                                                <div class="col-12 col-md-9">
                                                    @isset($roles)
                                                        <select name="role_id" id="role_id" class="form-control" required>
                                                            <option disabled>Select a role</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{$role->id}}" {{ $user->role_id == $role->id ? 'selected': ''}}>{{$role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        {{ ucfirst($user->role->name) }}
                                                    @endisset
                                                </div> 
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="active" class=" form-control-label">Status</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    @isset($roles)
                                                        <select name="active" id="active" class="form-control" required>
                                                            <option disabled>Select a status</option>
                                                            <option value="1" {{ $user->active == 1 ? 'selected': ''}}>Active</option>
                                                            <option value="0" {{ !$user->active ? 'selected': ''}}>Inactive</option>
                                                        </select>
                                                    @else
                                                        {{ $user->active == 1 ? 'Active' : 'Inactive' }}
                                                    @endisset
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="profile_pic" class="form-control-label">Upload Profile Picture</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="profile_pic" name="profile_pic" class="form-control-file form-control" accept="image/*">
                                                    <div class="invalid-feedback">Profile picture max size is 1 MB</div>
                                                    @if ($user->profile_pic)
                                                        <img style="margin-top: 20px;" src="{{ url('uploads/users/'.$user->profile_pic) }}" width="150" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div>User not found</div>
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