<?php
use App\Models\Posts;
if(isset($_GET['id'])){
$id=$_GET['id'];
$post = Posts::find($id);
}
?>

<div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost">
    <div class="content_wrapper p-3">
        <h2>New Post</h2>
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('post.partials.postsForm')
        <button type="submit" class="btn btn-search w-25">Save</button>
    </div>
</div>
</form>