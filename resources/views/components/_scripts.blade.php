{{-- {-- AUTH USER ACTION CHECK --}} --}}
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

<script type="text/javascript">
    var countAmt = 6;
    // LOAD MORE DATA [POST CARDS]
    $(document).ready(function () {
        $("#load_More").click(function (e) {
            // console.log('working');
            $(document).on({
                ajaxStart: function() { $("#load_More").text('Loading..');},
                ajaxStop: function() { $("#load_More").text('Load More'); }    
            });
            $.ajax({
                type: "POST",
                url: "/card-data",
                data: { load_Data: 'load_Data', _token: "{{ csrf_token() }}",count: countAmt},
                dataType: "json",
                success: function (data) {
                  if(data.cards == ""){
                    $("#load_More").hide();
                  }else{
                    $('#data-col').append(data.cards);
                  }
                  countAmt+=6;
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });
    });




    // LIKE AND DISLIKE ACTION
    $(document).ready(function () {
         //Like Action
        var countLike = parseInt($('#like_val').text());
        $("#like_Btn").click(function (e) {
            if ($('#like_Btn').is(':checked')) {
                var requestValue = true;
                $('#like_Btn_Icon').removeClass('far fa-heart actionIcon').addClass('fas fa-heart actionIcon');
                $("#dislike_Btn").prop("disabled", true );
                $('#like_val').text(++countLike)
            }else{
                var requestValue = false;
                $('#like_Btn_Icon').removeClass('fas fa-heart actionIcon').addClass('far fa-heart actionIcon');
                $("#dislike_Btn").prop("disabled", false );
                $('#like_val').text(--countLike);
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
                    // $('#like_val').text(data.count);
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
        var countDislike = parseInt($('#dislike_val').text());
        $("#dislike_Btn").click(function (e) {
            if ($('#dislike_Btn').is(':checked')) {
                var requestValue = true;
                $('#dislike_Btn_Icon').removeClass('far fa-thumbs-down actionIcon').addClass('fas fa-thumbs-down actionIcon');
                $("#like_Btn").prop( "disabled", true );
                $('#dislike_val').text(++countDislike)
            }else{
                var requestValue = false;
                $('#dislike_Btn_Icon').removeClass('fas fa-thumbs-down actionIcon').addClass('far fa-thumbs-down actionIcon');
                $("#like_Btn").prop( "disabled", false );
                $('#dislike_val').text(--countDislike)
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


    @if(Route::is('posts.show'))
    <script type="text/javascript">
    //POST COMMENT
    $(document).ready(function () {
        $("#post_Comment_Btn").click(function (e) {
            e.preventDefault();
            $(document).on({
              ajaxStart: function() { 
                $("#post_Comment_Btn").text('Posting ');
                jQuery('<i>', {
                    class: 'fa fa-spinner fa-spin',
                }).appendTo('#post_Comment_Btn');
            },
              ajaxStop: function() { 
                $("#post_Comment_Btn").text('Post Now'); 
            }    
            });
            
            var form = $('#comment').val();
            $.ajax({
                type: "POST",
                url: "/post-comments",
                data: { posted_Comment:"posted_Comment", _token: "{{ csrf_token() }}", formData: form, postId: {{$posts->id}}},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#comments_Container').html(data.comments);
                },
                error: function (error) {
                    console.log(error.responseText);
                },
            });
        });
    });
  </script>
    @endif
    
