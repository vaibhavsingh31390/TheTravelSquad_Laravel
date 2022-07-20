<div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost editPost">
    <div class="content_wrapper p-3">
        <h2>Update Post</h2>
        <form method="post" class="editProfile" id="editProfile" enctype="multipart/form-data" data-id="{{ $post->id }}">
            @csrf
            @include('post.partials.postsForm')
            <div>
                <input type="submit" id="test" class="btn btn-search w-25 test" value="Update">
            </div>
        </form>
    </div>
</div>
{{-- SEARCHED Posts [userDashboard/editPosts]--}}
