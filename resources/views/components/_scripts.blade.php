<script type="text/javascript">
    // NAV ICON CHANGE 
    $(document).on('click', '.navbar-toggler-icon', function () {
        $('#display_advance').toggle('1000');
        $("#toggle").toggleClass("bx-menu bx-menu-alt-left");
        console.log('working');
    })
</script>
{{-- {-- AUTH USER ACTION CHECK --}}
@if (Route::is('posts.show'))
<script>
    $(window).on("load", function () {
        var valuePostId = $('#like_Btn').attr("data-index-number");
        var valueUserId = $('#like_Btn').attr("data-id");
        var checked = 0;
        $.ajax({
            type: "POST",
            url: "/send-action",
            data: { action: 'verify', _token: "{{ csrf_token() }}", postId: valuePostId, userId: valueUserId },
            dataType: "json",
            success: function (data) {
                if (!jQuery.isEmptyObject(data.likeCount[0])) {
                    $("#like_Btn").prop('checked', true);
                    console.log('checked like');
                    checked = 1;
                } else if (!jQuery.isEmptyObject(data.dislikeCount[0])) {
                    $("#dislike_Btn").prop('checked', true);
                    console.log('checked dislike');
                    checked = 2;
                } else {
                    $("#like_Btn").prop('checked', false);
                    $("#dislike_Btn").prop('checked', false);
                }
                // CHECKED DONE
                if (checked == 2) {
                    $('#dislike_Btn_Icon').removeClass('bx bx-dislike actionIcon').addClass('bx bxs-dislike actionIcon');
                    $("#like_Btn").prop("disabled", true);
                } else if (checked == 1) {
                    $('#like_Btn_Icon').removeClass('bx bx-heart actionIcon').addClass('bx bxs-heart actionIcon');
                    $("#dislike_Btn").prop("disabled", true);
                }
            },
            error: function (error) {
                console.log(error.responseText);
                if (error.status == 401) {
                    alert("Please Login To Perform This Function !")
                }
            },
        });
    });
</script>
@endif

<script type="text/javascript">
    var countAmt = 6;
    // LOAD MORE DATA [POST CARDS]
    $(document).ready(function () {
        $("#load_More").click(function (e) {
            // console.log('working');
            $(document).on({
                ajaxStart: function () { $("#load_More").text('Loading..'); },
                ajaxStop: function () { $("#load_More").text('Load More'); }
            });
            $.ajax({
                type: "POST",
                url: "/card-data",
                data: { requestType: 'load_Data', _token: "{{ csrf_token() }}", count: countAmt },
                dataType: "json",
                success: function (data) {
                    if (data.cards == "") {
                        $("#load_More").hide();
                    } else {
                        $('#data-col').append(data.cards);
                    }
                    countAmt += 6;
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });
    });

</script>

@if (Route::is('postByCategory')  || Route::is('posts.index'))
<script>
    // SCROLL TO ADD DATA
     $(document).ready(function () {
         var count = 6;
         $(window).on('scroll',function () {
             var processing = false;
            // console.log('SCROLLTOP:'+ $(window).scrollTop() + '  WINDOW HEIGHT: ' + $(window).height() + '  WINDOW HEIGHT: ' + $(document).height())
             if (processing)
                 return false;
             if ($(window).scrollTop() + $(window).height() >= $(document).height() - 1) {
                 processing = true; //sets a processing AJAX request flag
                 var category = $('li.dropdown-item.active').text();
                 category = category.trim();
                 console.log('scrolled ' + category);
                  $(document).on({
                      ajaxStart: function () { console.log('Loading..'); },
                      ajaxStop: function () { console.log('Loaded'); }
                  });
                  $.ajax({
                      type: "POST",
                      url: "/card-data-category",
                      data: { requestType: 'load_Data_Category', _token: "{{ csrf_token() }}", count: count, categoryType: category },
                      dataType: "json",
                      success: function (data) {
                          if (data.cards == "") {
                          console.log('Data Empty Now.')
                          return
                      } else {
                          $('#data-col').append(data.cards);
                      }
                      count += 6;
                      },
                      error: function (error) {
                        console.log(error.responseText);
                          console.log('error');
                      },
                  });
             }
         });
     });

    // var page = 1;
    // count = 6;
    // $(window).scroll(function() {
    //   if($(window).scrollTop() + $(window).height() >= $(document).height()) {
    //     var category = $('li.dropdown-item.active').text();
    //     category = category.trim();
    //   page++;
    //   $(document).on({
    //     ajaxStart: function () { console.log('Loading..'); },
    //     ajaxStop: function () { console.log('Loaded'); }
    //     });
    //   load_more(page,category);
    //   }
    // });

    // function load_more(page, category){
    //     $.ajax({
    //                 type: "POST",
    //                 url: "/card-data-category?page=" + page,
    //                 data: { requestType: 'load_Data_Category', _token: "{{ csrf_token() }}", count: count, categoryType: category },
    //                 dataType: "json",
    //                 success: function (data) {
    //                     console.log(data)
    //                     if (data.cards == "") {
    //                     console.log('Data Empty Now.')
    //                     return
    //                 } else {
    //                     $('#data-col').append(data.cards);
    //                 }
    //                 count += 6;
    //                 },
    //                 error: function (error) {
    //                     console.log(error.responseText);
    //                     console.log('error');
    //                 },
    //             });
    //         };
</script>
@endif


<script>
    // LIKE AND DISLIKE ACTION
    $(document).ready(function () {
        //Like Action
        var countLike = parseInt($('#like_val').text());
        $("#like_Btn").click(function (e) {
            if ($('#like_Btn').is(':checked')) {
                var requestValue = true;
                $('#like_Btn_Icon').removeClass('bx bx-heart actionIcon').addClass('bx bxs-heart actionIcon');
                $("#dislike_Btn").prop("disabled", true);
                $('#like_val').text(++countLike)
            } else {
                var requestValue = false;
                $('#like_Btn_Icon').removeClass('bx bxs-heart actionIcon').addClass('bx bx-heart actionIcon');
                $("#dislike_Btn").prop("disabled", false);
                $('#like_val').text(--countLike);
            };
            var likeID = $(this).attr("data-id");
            var valuePostId = $(this).attr("data-index-number");
            var valueUserId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { action: 'like', value: requestValue, _token: "{{ csrf_token() }}", postId: valuePostId, userId: valueUserId },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    // $('#like_val').text(data.count);
                },
                error: function (error) {
                    console.log(error.responseText);
                    if (error.status == 401) {
                        alert("Please Login To Perform This Function !")
                        $('#like_Btn_Icon').removeClass('bx bxs-heart actionIcon').addClass('bx bx-heart actionIcon');
                    }
                },
            });
        });
        //Dislike Action
        var countDislike = parseInt($('#dislike_val').text());
        $("#dislike_Btn").click(function (e) {
            if ($('#dislike_Btn').is(':checked')) {
                var requestValue = true;
                $('#dislike_Btn_Icon').removeClass('bx bx-dislike actionIcon').addClass('bx bxs-dislike actionIcon');
                $("#like_Btn").prop("disabled", true);
                $('#dislike_val').text(++countDislike)
            } else {
                var requestValue = false;
                $('#dislike_Btn_Icon').removeClass('bx bxs-dislike actionIcon').addClass('bx bx-dislike actionIcon');
                $("#like_Btn").prop("disabled", false);
                $('#dislike_val').text(--countDislike)
            };
            var dislikeID = $(this).attr("data-id");
            var valuePostId = $(this).attr("data-index-number");
            var valueUserId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/send-action",
                data: { action: 'dislike', value: requestValue, _token: "{{ csrf_token() }}", postId: valuePostId, userId: valueUserId },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    if (error.status == 401) {
                        alert("Please Login To Perform This Function !")
                        $('#like_Btn_Icon').removeClass('bx bxs-dislike actionIcon').addClass('bx bx-dislike actionIcon');
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
            var form = $('#comment').val();
            if (form == '') {
                alert("Please Write Something");
                return
            }
            $(document).on({
                ajaxStart: function () {
                    $("#post_Comment_Btn").text('Posting ');
                    jQuery('<i>', {
                        class: 'fa fa-spinner fa-spin',
                    }).appendTo('#post_Comment_Btn');
                },
                ajaxStop: function () {
                    $("#post_Comment_Btn").text('Post Now');
                }
            });
            $.ajax({
                type: "POST",
                url: "/post-comments",
                data: { posted_Comment: "posted_Comment", _token: "{{ csrf_token() }}", formData: form, postId: {{ $posts-> id}}},
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