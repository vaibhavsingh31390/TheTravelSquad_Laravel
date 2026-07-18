<script type="text/javascript">
    // NAV ICON CHANGE 
    $(document).on('click', '.navbar-toggler-icon', function () {
        $('#display_advance').toggle('1000');
        $("#toggle").toggleClass("bx-menu bx-menu-alt-left");
        console.log('working');
    })

    // LOAD MORE DATA [POST CARDS]
    var countAmt = 6;
    $(document).ready(function () {
        $("#load_More").click(function (e) {
            var $button = $('#load_More');
            if ($button.prop('disabled')) return;
            $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading');

            $.ajax({
                type: "POST",
                url: "/card-data",
                data: { requestType: 'load_Data', _token: "{{ csrf_token() }}", count: countAmt },
                dataType: "json",
                success: function (data) {
                    if (data.cards && data.cards.trim() !== '') {
                        $('#data-col').append(data.cards);
                    }
                    if (data.nextOffset) {
                        countAmt = data.nextOffset;
                    } else {
                        countAmt += 6;
                    }
                    if (!data.hasMore || !data.cards || data.cards.trim() === '') {
                        $button.hide();
                    } else {
                        $button.prop('disabled', false).text('Load More');
                    }
                },
                error: function (error) {
                    console.log(error.responseText);
                    $button.prop('disabled', false).text('Load More');
                },
            });
        });
    });
</script>

@guest
    <script>
        $(document).on("click","#like_Btn", function (e) {
            alert('Please Login To Perform This Action !!')
        });

        $(document).on("click","#dislike_Btn",function (e) {
            alert('Please Login To Perform This Action !!')
        });
    </script>
@endguest


{{-- {-- AUTH USER ACTION CHECK --}}
@if (Route::is('posts.show') && Auth::check())
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

@auth
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
@endauth

@if (Route::is('postByCategory') || Route::is('posts.index') || Route::is('postByTag'))
<script>
    $(document).ready(function () {
        var $grid = $('#data-col');
        var $sentinel = $('#scroll-sentinel');
        if (!$grid.length || !$sentinel.length) return;

        var offset = parseInt($grid.data('offset'), 10) || 6;
        var category = $grid.data('category') || 'All Posts';
        var tagSlug = $grid.data('tag') || '';
        var loading = false;
        var hasMore = true;

        function loadMorePosts() {
            if (loading || !hasMore) return;
            loading = true;
            $('#loader').removeClass('d-none');

            $.ajax({
                type: "POST",
                url: "/card-data-category",
                data: {
                    requestType: 'load_Data_Category',
                    _token: "{{ csrf_token() }}",
                    categoryType: category,
                    tagSlug: tagSlug,
                    count: offset
                },
                dataType: "json",
                success: function (data) {
                    if (data.cards && data.cards.trim() !== '') {
                        $grid.append(data.cards);
                    }
                    if (data.nextOffset) {
                        offset = data.nextOffset;
                    } else {
                        offset += 6;
                    }
                    if (data.hasMore === false || !data.cards || data.cards.trim() === '') {
                        hasMore = false;
                        $sentinel.remove();
                    }
                    loading = false;
                    $('#loader').addClass('d-none');
                },
                error: function (error) {
                    console.log(error.responseText);
                    loading = false;
                    $('#loader').addClass('d-none');
                }
            });
        }

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                if (entries[0].isIntersecting) {
                    loadMorePosts();
                }
            }, { rootMargin: '240px' });
            observer.observe($sentinel[0]);
        } else {
            var scrollTimer;
            $(window).on('scroll', function () {
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(function () {
                    var nearBottom = $(window).scrollTop() + $(window).height() >= $(document).height() - 320;
                    if (nearBottom) loadMorePosts();
                }, 120);
            });
        }
    });
</script>
@endif

@if(Route::is('posts.show'))
<script type="text/javascript">
    //POST COMMENT
    $(document).ready(function () {
        $(document).on('click',"#post_Comment_Btn",function (e) {
            e.preventDefault();
            var form = $('#comment').val();
            if (form == '') {
                alert("Please Write Something");
                return
            }
            $('#loader_Comments').removeClass('d-none');
            $("#post_Comment_Btn").text('Posting ');
            jQuery('<i>', {class: 'fa fa-spinner fa-spin',}).appendTo('#post_Comment_Btn');
            $.ajax({
                type: "POST",
                url: "/post-comments",
                data: { requestType: "posted_Comment", _token: "{{ csrf_token() }}", formData: form, postId: {{ $posts-> id}}},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    setTimeout(() => {
                    $("#post_Comment_Btn").text('Post Now');
                    $('#loader_Comments').addClass('d-none')
                    $("#comments_Container").fadeOut(0,function(){
                        $(this).html(data.comments).fadeIn();
                    }); 
                    }, 1000);
                    
                },
                error: function (error) {
                    console.log(error.responseText);
                },
            });
        });
    });
</script>
@endif