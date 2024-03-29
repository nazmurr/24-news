@extends('layouts.admin')

@section('title', 'Edit Post')

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
                        Edit Post    
                    @endcomponent

                    @component('admin.includes.formErrors')
        
                    @endcomponent
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="/admin/posts/{{ $post->id }}" method="POST" class="form-horizontal needs-validation" novalidate enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">Title</label>
                                            <input id="title" name="title" type="text" class="form-control" placeholder="Enter your post title" value="{{ $post->title }}" required>
                                            <div class="invalid-feedback">Title is required</div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="category_id" class="control-label mb-1">Category</label>
                                            <select name="category_id" id="category_id" class="form-control custom-select" required>
                                                <option value="">Select a category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{ $post->category_id == $category->id ? 'selected': ''}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Category is required</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content" class="control-label mb-1">Content</label>
                                            <textarea name="content" id="article-ckeditor" rows="9" class="form-control" placeholder="Enter your post content" required>{{ $post->content }}</textarea>
                                            <div class="invalid-feedback">Content is required</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="featured_img_file" class="control-label mb-1">Featured Image</label>
                                            <input type="file" id="featured_img_file" name="featured_img_file" class="form-control-file form-control" accept="image/*">
                                            <div class="invalid-feedback">Featured image max size is 2 MB</div>
                                            <img @if ($post->photo_id) style="display: block" @endif src="{{ $post->photo_id ? url('uploads/posts/'.$post->photo['filename']): '' }}" id="featured_img" />
                                            <p><a href="#" @if ($post->photo_id) style="display: block" @endif class="remove_img_link">Remove Image</a></p>
                                        </div>
                                        @if (Auth::user()->role->name === 'administrator')
                                            <div class="form-group has-success">
                                                <label for="post_status" class="control-label mb-1">Post Status</label>
                                                <select name="post_status" id="post_status" class="form-control custom-select" required>
                                                    <option value="pending" {{ $post->post_status == 'pending' ? 'selected': ''}}>Pending</option>
                                                    <option value="publish" {{ $post->post_status == 'publish' ? 'selected': ''}}>Published</option>
                                                </select>
                                                <div class="invalid-feedback">Post status is required</div>
                                            </div>
                                        @endif
                                        <div>
                                            <input type="hidden" name="remove_img" id="remove_img" value="0" />
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

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    };
    CKEDITOR.replace( 'article-ckeditor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});

</script>

@push('scripts')

<script>
    function readURL(input) {
        if(input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                jQuery('#featured_img').show();
                jQuery('#featured_img').attr('src', e.target.result);
                jQuery('.remove_img_link').show();
                jQuery('#remove_img').val(0);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    jQuery('#featured_img_file').change(function() {
        readURL(this);
    });

    jQuery('.remove_img_link').click(function(event) {
        event.preventDefault();
        jQuery('#featured_img_file').val('');
        jQuery('#featured_img').attr('src', '').hide();
        jQuery('#remove_img').val(1);
        jQuery(this).hide();
    });

</script>

@endpush

@endsection