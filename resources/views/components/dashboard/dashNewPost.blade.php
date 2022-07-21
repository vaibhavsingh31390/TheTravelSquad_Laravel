<div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost">
<div class="content_wrapper p-3">
<h2>New Post</h2>
<form method="post" class="postsFormNew" id="posts_Form_New" enctype="multipart/form-data">
@csrf
@include('post.partials.postsForm')
<div>
<input type="submit" id="posts_Form_Btn" class="btn btn-search w-25" value="Save">
</div>
</form>
</div>
</div>
</form>