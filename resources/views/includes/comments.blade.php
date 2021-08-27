<div class="container-fluid pb-4 pt-5">
    <div class="container animate-box">
        @if (count($comments))
            <div id="comments">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Comments ({{ count($comments) }})</div>
                </div>
                @foreach ($comments as $comment)
                    <div class="comment-item">
                        <div class="comment-user-avatar">
                            <a href="{{ url('/authors/'.$comment->user['id']) }}">
                                <img 
                                    src="{{ $comment->user['profile_pic'] ? url('uploads/users/'.$comment->user['profile_pic']) : url('images/admin-default-avatar.png') }}" 
                                    alt="user pic" 
                                    class="comment_avatar"
                                >
                            </a>
                        </div>
                        <div class="comment-content">
                            <div class="most_fh5co_treding_font"> 
                                <a href="{{ url('/authors/'.$comment->user['id']) }}">{{ $comment->user['name'] }}</a>
                                <span class="most_fh5co_treding_font_123 comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="comment-text">
                                {{ $comment->comment }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="add-comment-form">
            @guest
            <h4>Please <a href="{{ url('/login') }}">login</a> to post a comment.</h4>
            @endguest
            @auth
            <h4>Add your comment</h4>
            <div class="row">
                <div class="col-12">
                    <form action="/comments" method="POST" class="row" id="fh5co_contact_form">
                        @csrf
                        <div class="col-12 py-3">
                            <textarea name="comment" class="form-control fh5co_contacts_message" placeholder="Say something..." required></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        <div class="col-12 py-3 text-right"> <button type="submit" class="btn contact_btn">Post Comment</button> </div>
                    </form>
                    @if(Session::has('flash_contact_submit_success'))
                        <div class="sufee-alert alert alert-success">
                            {{ Session('flash_contact_submit_success') }}
                        </div>
                    @endif
                    @if(Session::has('flash_contact_submit_error'))
                        <div class="sufee-alert alert alert-danger">
                            {{ Session('flash_contact_submit_error') }}
                        </div>
                    @endif
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>