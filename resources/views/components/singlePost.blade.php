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
                <span class="like" id="like_Btn" data-index-number="{{ $posts->id }}" data-id="{{ $posts->users_id }}">
                    <i class="far fa-thumbs-up" id="styleChangeLike"></i>
                    <span id="like_val">{{ $posts->likeCount()->count() }}</span>
                </span>
                <span class="dislike" id="dislike_Btn" data-id="{{ $posts->id }}">
                    <i class="far fa-thumbs-down" id="styleChangeDislike"></i>
                    <span id="dislike_val">{{ $posts->dislikeCount()->count() }}</span>
                </span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4 banner">
            <img src="{{ $posts->image_url  }}" alt="Demo_img">
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

<script>
    var likeCount = 2;
    $(document).ready(function () {
        $("#like_Btn").click(function (e) {
            var likeID = $(this).attr("data-id");
            var value = $("#like_val").text();
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { action: 'like', value:true , _token: "{{ csrf_token() }}", id: likeID, counter: likeCount},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    likeCount++;
                },
                error: function (error) {
                    console.log(error.responseText);
                    if(error.status == 401){
                        alert("Please Login To Perform This Function !")
                    }
                },
            });
        });
    });
</script>
