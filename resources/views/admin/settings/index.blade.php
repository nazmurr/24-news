@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Settings    
                    @endcomponent

                    @if(Session::has('flash_admin'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ Session('flash_admin') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @component('admin.includes.formErrors')
        
                    @endcomponent
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <form action="/admin/settings" method="POST" class="form-horizontal needs-validation" novalidate>
                                    @csrf
                                    <div class="card-body card-block">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="linkedin_url" class=" form-control-label">LinkedIn URL</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                            <input 
                                                type="text" 
                                                id="linkedin_url" 
                                                name="linkedin_url" 
                                                placeholder="Enter URL" 
                                                value="{{$linkedinUrl}}" 
                                                class="form-control"
                                            >
                                                <div class="invalid-feedback">Field is required</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="gplus_url" class=" form-control-label">Google Plus URL</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input 
                                                    type="text" 
                                                    id="gplus_url" 
                                                    name="gplus_url" 
                                                    placeholder="Enter URL" 
                                                    value="{{$gplusUrl}}" 
                                                    class="form-control"
                                                >
                                                <div class="invalid-feedback">Field is required</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="twitter_url" class=" form-control-label">Twitter URL</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input 
                                                    type="text" 
                                                    id="twitter_url" 
                                                    name="twitter_url" 
                                                    placeholder="Enter URL"
                                                    value="{{$twitterUrl}}" 
                                                    class="form-control"
                                                >
                                                <div class="invalid-feedback">Field is required</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="facebook_url" class=" form-control-label">Facebook URL</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input 
                                                    type="text" 
                                                    id="facebook_url" 
                                                    name="facebook_url" 
                                                    placeholder="Enter URL"
                                                    value="{{$facebookUrl}}" 
                                                    class="form-control"
                                                >
                                                <div class="invalid-feedback">Field is required</div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="about_info" class=" form-control-label">About Info</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea 
                                                    id="about_info" 
                                                    name="about_info" 
                                                    rows="5" 
                                                    class="form-control"
                                                >{{$aboutInfo}}</textarea>
                                                <div class="invalid-feedback">Field is required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Save
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