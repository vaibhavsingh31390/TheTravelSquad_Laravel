{{-- $posts to acccess posts related data from model via posts controller --}}
<?php
use App\Models\Posts;
use Illuminate\Foundation\Auth\User;
    $comments = $posts->comments()->get();
?>
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
                <span class="like">
                    <i class="fas fa-thumbs-up"></i>
                    {{ $posts->like }}
                </span>
                <span class="dislike">
                    <i class="fas fa-thumbs-down"></i>
                    {{ $posts->dislike }}
                </span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4 banner">
            <img src="{{ $posts->image_url  }}" alt="">
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 mt-4 content">
            <?php $cont = nl2br($posts->content); ?>
            <p style="text-align: justify; white-space: pre-wrap;"><?php echo str_replace('<br />', '<br>', $cont) ?></p>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 author">
            <p style="text-align: justify; white-space: pre-wrap;">Post By: <span class="authorName">{{ $Data['author']->first()->name }}</span></p>
        </div>
    </div>
</div>


<div class="container px-4 mb-4 comments_Container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 comments_Layout">
            <h1 class="mt-3 headingPost">Comments</h1>
            <hr>
            <div class="col-md-12 col-lg-12 col-sm-12 comments_Form">
            @guest
                <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>  to post a comment!</p>
            @else
                <form action="{{ route('add.comment', ['id' => $posts->id]) }}" method="post" id="postComment">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-2">
                        <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
                        <label for="comment">Post yout comment here..</label>
                    </div>
                    <input type="hidden" name="posts_id" id="postId" value="{{ $posts->id }}">
                    <button type="submit" class="btn">Post Now</button>
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
                        $findName = Posts::where('id', '=', $comment->posts_id)->pluck('users_id');
                        $author = User::where('id', '=', $findName)->get();
                        echo $author->first()->name;
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
            <div class="col-sm-12 col-md-12 col-lg-12 mt-3 p-2 border">
                <div class="user_Comment px-2">
                    <p>No comments posted.</p>
                </div>
            </div>
            @endforelse

        </div>

    </div>
</div>
{{-- 
<script>
    $('#postComment').submit(function(e){
        e.preventDefault();
        let comment = $('#comment').val()
        let token = $('input[name=_token]').val()

        $.ajax({
            url: "{{route('comment.add')}}",
            type: 'Post',
            contentType: false,
            processData: false,
            data: {
                comment:comment,
                _token: token
            },
            success:function (response){
                if (response){
                    console.log('worked');
                    $('#postComment').reset();
                }
            }
        });
    });
</script> --}}