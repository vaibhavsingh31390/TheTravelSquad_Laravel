<?php
use App\Models\User;
?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 comments_Layout">
            <h1 class="mt-3 headingPost">Comments</h1>
            <hr>
            <div class="col-md-12 col-lg-12 col-sm-12 comments_Form">
            @guest
                <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>  to post a comment!</p>

            @else
                <form method="post" id="postCommentForm">
                    @csrf
                    <div class="form-floating mb-2">
                        <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
                        <label for="comment">Post yout comment here..</label>
                    </div>
                    <button type="submit" class="btn" id="post_Comment_Btn">Post Now</button>
                </form>
            @endguest
            </div>
            <h3 class="mt-3 mb-2 headingPost">Recent Comments
                <i class="fas fa-comment"></i>
            </h3>
            @forelse ($comments as $comment)
            <div class="col-sm-12 col-md-12 col-lg-12 mt-2 mb-3 p-2 border commentBody">
                <div class="user_Img d-flex justify-content-start align-items-center mb-2">
                    <div class="user_DataPhoto">
                        <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61" alt="user_Photo">
                    </div>
                    <small class="ms-2 userName">
                        <?php
                            $userId = $comment->users_id;
                            $author = User::where('id', '=', $userId)->pluck('name');
                            echo $author->first();
                        ?>
                    </small>
                </div>
                <div class="user_Comment px-2">
                    <p>{{ $comment->comment }}</p>
                    <div class="date">
                        <small>Posted: {{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-sm-12 col-md-12 col-lg-12 mt-3 mb-4 p-2 border">
                <div class="user_Comment px-2">
                    <p>No comments posted.</p>
                </div>
            </div>
            @endforelse

        </div>
    </div>
<script>
    $(document).ready(function () {
         //Like Action
        $("#post_Comment_Btn").click(function (e) {
            e.preventDefault();
            console.log('Clicked');
            var form = $('#comment').val();
            $.ajax({
                type: "POST",
                url: "/post-comments",
                data: { posted_Comment:"posted_Comment", _token: "{{ csrf_token() }}", formData: form, postId: {{ $posts->id }}},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#comments_Container').html(data.comments);
                    alert('Comment Added');
                },
                error: function (error) {
                    console.log(error.responseText);
                },
            });
        });
    });
</script>