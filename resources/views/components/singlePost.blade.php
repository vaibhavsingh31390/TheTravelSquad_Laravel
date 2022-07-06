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
                <span class="likeContainer">
                    <label>
                        <input type="checkbox" name="likeBtn" id="like_Btn" data-index-number="{{ $posts->id }}" data-id="{{ $posts->users_id }}">
                        <i class="far fa-heart actionIcon" id="like_Btn_Icon"></i>
                    </label>
                    <span id="like_val">{{ $posts->likeCount()->count() }}</span>
                </span>
                <span class="dislikeContainer" >
                    <label>
                        <input type="checkbox" name="dislikeBtn" id="dislike_Btn" data-index-number="{{ $posts->id }}" data-id="{{ $posts->users_id }}">
                        <i class="far fa-thumbs-down actionIcon" id="dislike_Btn_Icon"></i>
                    </label>
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

{{-- AUTH USER ACTION CHECK --}}
@auth
    <script>
        $(window).on("load", function () {
            var valuePostId = $('#like_Btn').attr("data-index-number");
            var valueUserId = $('#like_Btn').attr("data-id");
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { action: 'verify', _token: "{{ csrf_token() }}", postId: valuePostId, userId: valueUserId},
                dataType: "json",
                success: function (data) {
                    if(!jQuery.isEmptyObject(data.likeCount[0])){
                        $("#like_Btn").prop('checked', true);
                        console.log('checked like');
                    }else if(!jQuery.isEmptyObject(data.dislikeCount[0])){
                        $("#dislike_Btn").prop('checked', true);
                        console.log('checked dislike');
                    }else{
                        $("#like_Btn").prop('checked', false);
                        $("#dislike_Btn").prop('checked', false);
                    }
                    // CHECKED DONE
                    if ($('#like_Btn').is(':checked')) {
                        $('#like_Btn_Icon').removeClass('far fa-heart actionIcon').addClass('fas fa-heart actionIcon');
                        $("#dislike_Btn").prop("disabled", true );
                    }else{
                        $('#like_Btn_Icon').removeClass('fas fa-heart actionIcon').addClass('far fa-heart actionIcon');
                        $("#dislike_Btn").prop("disabled", false );
                    };
                },
                error: function (error) {
                    console.log(error.responseText);
                    if(error.status == 401){
                    alert("Please Login To Perform This Function !")
                    }
                },
            });
        });
    </script>
@endauth


<script>
    $(document).ready(function () {
         //Like Action
        $("#like_Btn").click(function (e) {
            if ($('#like_Btn').is(':checked')) {
                var requestValue = true;
                $('#like_Btn_Icon').removeClass('far fa-heart actionIcon').addClass('fas fa-heart actionIcon');
                $("#dislike_Btn").prop("disabled", true );
            }else{
                var requestValue = false;
                $('#like_Btn_Icon').removeClass('fas fa-heart actionIcon').addClass('far fa-heart actionIcon');
                $("#dislike_Btn").prop("disabled", false );
            };
            var likeID = $(this).attr("data-id");
            var valuePostId = $(this).attr("data-index-number");
            var valueUserId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { action: 'like', value:requestValue , _token: "{{ csrf_token() }}", postId: valuePostId, userId: valueUserId},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#like_val').text(data.count);
                },
                error: function (error) {
                    console.log(error.responseText);
                    if(error.status == 401){
                        alert("Please Login To Perform This Function !")
                        $('#like_Btn_Icon').removeClass('fas fa-heart actionIcon').addClass('far fa-heart actionIcon');
                    }
                },
            });
        });
        //Dislike Action
        $("#dislike_Btn").click(function (e) {
            if ($('#dislike_Btn').is(':checked')) {
                var requestValue = true;
                $('#dislike_Btn_Icon').removeClass('far fa-thumbs-down actionIcon').addClass('fas fa-thumbs-down actionIcon');
                $("#like_Btn").prop( "disabled", true );
            }else{
                var requestValue = false;
                $('#dislike_Btn_Icon').removeClass('fas fa-thumbs-down actionIcon').addClass('far fa-thumbs-down actionIcon');
                $("#like_Btn").prop( "disabled", false );
            };
            var dislikeID = $(this).attr("data-id");
            var valuePostId = $(this).attr("data-index-number");
            var valueUserId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { action: 'dislike', value: requestValue , _token: "{{ csrf_token() }}", postId: valuePostId, userId: valueUserId},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#dislike_val').text(data.count);
                },
                error: function (error) {
                    console.log(error.responseText);
                    if(error.status == 401){
                        alert("Please Login To Perform This Function !")
                        $('#like_Btn_Icon').removeClass('fas fa-heart actionIcon').addClass('far fa-heart actionIcon');
                    }
                },
            });
        });
    });
</script>
