<div class="row">
<div class="col-md-12 col-lg-12 col-sm-12 comments_Layout">
<h1 class="mt-3 headingPost">Comments</h1>
<hr>
<div class="col-md-12 col-lg-12 col-sm-12 comments_Form">
@guest
<p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>  to post a comment!</p>
@else
<form method="post" id="postCommentForm">
@csrf
<div class="form-floating mb-2">
<textarea name="comment" class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
<label for="comment">Post yout comment here..</label>
</div>
<button type="submit" class="btn" id="post_Comment_Btn">
Post Now
</button>
</form>
@endguest
</div>
<h3 class="mt-3 mb-2 headingPost">Recent Comments
{{-- <i class='bx bxs-message-square-add'></i> --}}
</h3>
@forelse ($comments as $comment)
<div class="col-sm-12 col-md-12 col-lg-12 mt-2 mb-3 p-2 border-bottom commentBody">
<div class="user_Img d-flex justify-content-start align-items-center mb-2">
<div class="user_DataPhoto">
<img src="{{ $user->find($comment->users_id)->media->url() }}" alt="user_Photo">
</div>
<small class="ms-2 userName">
{{ 
$user->where('id', '=', $comment->users_id)->pluck('name')->first()
}}
</small>
</div>
<div class="user_Comment px-2">
<p>{{ $comment->comment }}</p>
<div class="date">
<small>Posted: {{ $comment->created_at->diffForHumans() }}</small>
</div>
</div>
</div>
@empty
<div class="col-sm-12 col-md-12 col-lg-12 mt-3 mb-4 p-2 border">
<div class="user_Comment px-2">
<p class="mb-0">No comments posted.</p>
</div>
</div>
@endforelse
<div class="d-flex justify-content-center align-items-center loader_Comments d-none" id="loader_Comments">
<div class="spinner-border spinner" role="status" style="">
<span class="sr-only">Loading...</span>
</div>
</div>
</div>
</div>
