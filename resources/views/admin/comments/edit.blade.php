@extends('layouts.admin')

@section('title', 'Edit Comment')

@section('content')

<style>
    #featured_img {
        margin-top: 20px;
        width: 300px;
        display: none;
    }

    .remove_img_link {
        margin-top: 10px;
        display: none;
    }
</style>

<section class="m-t-75 statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @component('admin.includes.title')
                        Edit Comment    
                    @endcomponent

                    @component('admin.includes.formErrors')
        
                    @endcomponent
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="/admin/comments/{{ $comment->id }}" method="POST" class="form-horizontal needs-validation" novalidate>
                                        @csrf
                                        @method('PATCH')
                                       
                                        <div class="form-group">
                                            <label for="content" class="control-label mb-1">Comment</label>
                                            <textarea name="comment" rows="9" class="form-control" placeholder="Enter your comment" required>{{ $comment->comment }}</textarea>
                                            <div class="invalid-feedback">Comment is required</div>
                                        </div>
                                        
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                                Save
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
    </div>
</section>

@endsection