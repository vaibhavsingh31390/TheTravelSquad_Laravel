<div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost">
<div class="content_wrapper p-3">
<h2>New Post</h2>
<form method="post" class="postsFormNew" id="posts_Form_New" enctype="multipart/form-data">
@csrf
@include('components.errors')
<div class="mb-3">
<label for="category_Menu" class="form-label">Category</label>
<select name="category_Menu" id="category_Menu" class="form-select {{ $errors->has('title') ? 'is-invalid' : '' }}"
aria-label="Default select example">
<option disabled>
{{ 'Select One Of The Following Category'}}
</option>
<option value="Travel">Travel</option>
<option value="Technology">Technology</option>
<option value="Sports">Sports</option>
<option value="Food">Food</option>
<option value="Fashion">Fashion</option>
<option value="Others">Others</option>
</select>
</div>
@include('post.partials.postsForm')
<div>
<input type="submit" id="posts_Form_Btn" class="btn btn-search w-25" value="Save">
</div>
</form>
</div>
</div>
</form>