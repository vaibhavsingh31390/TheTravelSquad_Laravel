<div class="col-12 newPost">
<div class="content_wrapper">
<h2>New Post</h2>
<form method="post" class="postsFormNew" id="posts_Form_New" enctype="multipart/form-data">
@csrf
@include('components.errors')
<div class="mb-3">
<label for="category_Menu" class="form-label">Category</label>
<select name="category_Menu" id="category_Menu" class="form-select {{ $errors->has('category_Menu') ? 'is-invalid' : '' }}" aria-label="Select category" required>
<option value="" selected disabled>Select category</option>
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
<input type="submit" id="posts_Form_Btn" class="btn btn-search" value="Publish">
</div>
</form>
</div>
</div>
