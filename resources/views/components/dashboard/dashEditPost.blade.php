<div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost editPost">
<div class="content_wrapper p-3">
<h2>Update Post</h2>
<form method="post" class="postsFormUpdate" id="posts_Form_Update" enctype="multipart/form-data" data-id="{{ $post->id }}">
@csrf
@include('components.errors')
<div class="mb-3">
<label for="category_Menu" class="form-label">Category</label>
<select name="category_Menu" id="category_Menu" class="form-select {{ $errors->has('title') ? 'is-invalid' : '' }}"
aria-label="Default select example">
@if ($post->category()->count() > 0)
    <option selected value="{{$post->category()->first()->category_Menu}}" disabled>
        {{ $post->category()->first()->category_Menu}}
    </option>
    @else
    <option selected disabled>
        {{ 'Select One Of The Following Category'}}
    </option>
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
<div>
<input type="submit" id="posts_Form_Btn" class="btn btn-search w-25" value="Update">
</div>
</form>
</div>
</div>
{{-- SEARCHED Posts [userDashboard/editPosts]--}}
