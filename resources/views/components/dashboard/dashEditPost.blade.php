<div class="col-12 newPost editPost">
<div class="content_wrapper">
<h2>Update Post</h2>
<form method="post" class="postsFormUpdate" id="posts_Form_Update" enctype="multipart/form-data" data-id="{{ $post->id }}">
@csrf
@include('components.errors')
<div class="mb-3">
<label for="category_Menu" class="form-label">Category</label>
<select name="category_Menu" id="category_Menu" class="form-select {{ $errors->has('title') ? 'is-invalid' : '' }}" aria-label="Select category">
@if ($post->category()->count() > 0)
<option value="{{ $post->category()->first()->category_Menu }}" selected>
{{ $post->category()->first()->category_Menu }}
</option>
@else
<option value="" selected disabled>Select category</option>
@endif
<option value="Travel">Travel</option>
<option value="Technology">Technology</option>
<option value="Sports">Sports</option>
<option value="Food">Food</option>
<option value="Fashion">Fashion</option>
<option value="Others">Others</option>
</select>
</div>
@include('post.partials.postsForm')
<div class="mt-4">
<input type="submit" id="posts_Form_Btn" class="btn btn-search" value="Save">
</div>
</form>
</div>
</div>
