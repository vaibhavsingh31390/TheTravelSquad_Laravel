<div class="row">
<div class="col-12 comments_Layout">
<p class="comments-kicker mb-2">Discussion</p>
<h2 class="comments-title mb-0">Comments</h2>
<hr class="comments-divider my-4">

<div class="comments_Form mb-4">
@guest
<div class="comments-guest">
<div class="comments-guest__icon" aria-hidden="true">
<i class='bx bx-message-rounded-dots'></i>
</div>
<div class="comments-guest__body">
<p class="comments-guest__title">Join the conversation</p>
<p class="comments-guest__text">Sign in or create a free account to share your thoughts on this story.</p>
<div class="comments-guest__actions">
<a href="{{ route('login') }}" class="btn-pill">Sign in</a>
<a href="{{ route('register') }}" class="btn-pill-outline">Create account</a>
</div>
</div>
</div>
@else
<form method="post" id="postCommentForm">
@csrf
<div class="mb-3">
<label for="comment" class="form-label">Your comment</label>
<textarea name="comment" class="form-control" placeholder="Share your thoughts..." id="comment" rows="4"></textarea>
</div>
<button type="submit" class="btn" id="post_Comment_Btn">Post Comment</button>
</form>
@endguest
</div>

<h3 class="comments-recent-heading mb-3">Recent</h3>

@forelse ($comments as $comment)
<div class="commentBody">
<div class="user_Img d-flex align-items-center mb-2">
<div class="user_DataPhoto">
<img src="{{ $user->find($comment->users_id)?->media?->url() ?? \App\Models\Media::placeholderAvatarUrl() }}" alt="user_Photo">
</div>
<small class="ms-2 userName">
{{ $user->where('id', '=', $comment->users_id)->pluck('name')->first() }}
</small>
</div>
<div class="user_Comment">
<p class="mb-1">{{ $comment->comment }}</p>
<div class="date">
<small>{{ $comment->created_at->diffForHumans() }}</small>
</div>
</div>
</div>
@empty
<div class="comments-empty">
<div class="comments-empty__icon" aria-hidden="true">
<i class='bx bx-chat'></i>
</div>
<p class="comments-empty__title">No comments yet</p>
<p class="comments-empty__text">Be the first to share your perspective.</p>
</div>
@endforelse

<div class="d-flex justify-content-center align-items-center loader_Comments d-none" id="loader_Comments">
<div class="spinner-border spinner" role="status">
<span class="visually-hidden">Loading...</span>
</div>
</div>
</div>
</div>
