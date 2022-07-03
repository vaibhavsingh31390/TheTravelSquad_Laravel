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
                <span class="like" id="like_Btn" data-id="{{ $posts->id }}">
                    <i class="far fa-thumbs-up" id="styleChangeLike"></i>
                    <span id="like_val">{{ $posts->like }}</span>
                </span>
                <span class="dislike" id="dislike_Btn" data-id="{{ $posts->id }}">
                    <i class="far fa-thumbs-down" id="styleChangeDislike"></i>
                    <span id="dislike_val">{{ $posts->dislike }}</span>
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

<script>
    var likeCount = 2;
    var dislikeCount = 2;
    $(document).ready(function () {
        $("#like_Btn").click(function (e) {
            var likeID = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { like: 'like', _token: "{{ csrf_token() }}", id: likeID, counter: likeCount},
                dataType: "json",
                success: function (data) {
                    $('#like_val').text(data.count);
                    console.log(data.count + " Like " + likeCount);
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
        $("#dislike_Btn").click(function (e) {
            var dislikeID = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { dislike: 'dislike', _token: "{{ csrf_token() }}", id: dislikeID, counter: dislikeCount},
                dataType: "json",
                success: function (data) {

                    $('#dislike_val').text(data.count);
                    console.log(data.count + " Dislike " + dislikeCount);
                    dislikeCount++;
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
