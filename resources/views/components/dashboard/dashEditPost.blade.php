<div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost editPost">
    <div class="content_wrapper p-3">
        <h2>Update Post</h2>
        <form action="{{ route('posts.update', ['post'=>$id]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @include('post.partials.postsForm')
            <button type="submit" class="btn btn-search w-25">Update</button>
        </form>
    </div>
</div>
{{-- SEARCHED Posts [userDashboard/editPosts]--}}