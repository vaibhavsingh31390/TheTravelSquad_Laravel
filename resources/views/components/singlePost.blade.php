<div class="container mt-5 post-container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<h1 class="text-left mt-4 headingPost" style="font-weight: 600">{{ $posts->title }}</h1>
</div>
<hr>
<div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-between">
<div class="date">
<small style="font-size: 16px;">{{ $posts->created_at->diffForHumans() }}</small>
</div>
<div class="like_dislike d-flex justify-content-between">
<span class="likeContainer">
<label>
<input type="checkbox" name="likeBtn" id="like_Btn" data-index-number="{{ $posts->id }}" data-id="{{ $posts->users_id }}">
<i class='bx bx-heart actionIcon' id="like_Btn_Icon"></i>
</label>
<span id="like_val">{{ $posts->likeCount()->count() }}</span>
</span>
<span class="dislikeContainer" >
<label>
<input type="checkbox" name="dislikeBtn" id="dislike_Btn" data-index-number="{{ $posts->id }}" data-id="{{ $posts->users_id }}">
<i class='bx bx-dislike actionIcon' id="dislike_Btn_Icon"></i>
</label>
<span id="dislike_val">{{ $posts->dislikeCount()->count() }}</span>
</span>
</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 mt-4 banner">
<img src=@if ($posts->media){{ $posts->media->url() }}@else{{ null }}@endif alt="Demo_img">
</div>

<div class="col-lg-12 col-md-12 col-sm-12 mt-4 content">
<?php $cont = nl2br($posts->content); ?>
<p style="text-align: justify; white-space: pre-wrap;"><?php echo str_replace('<br />', '<br>', $cont) ?></p>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 author">
<p style="text-align: justify; white-space: pre-wrap;">Post By: <span class="authorName">{{ $author }}</span></p>
</div>
</div>
</div>


