<script type="text/javascript">
    class ajaxRequest {
        static dahsboard_Home() {
            $.ajax({
                type: "POST",
                url: "/dashHome",
                data: {
                    dashData: "load_Data",
                    _token: "{{ csrf_token() }}",
                    value: "NewPost",
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#ajax_Fetch_Data").html(data.Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Fetch_All_Posts() {
            $.ajax({
                type: "POST",
                url: "/userDashboard/myPosts",
                data: { load_Data: "load_Data", _token: "{{ csrf_token() }}" },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#ajax_Fetch_Data").html(data.all_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Search_Posts(val) {
            $.ajax({
                type: "POST",
                url: "/userDashboard/search",
                data: {
                    load_Data: "load_Data",
                    value: val,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#ajax_Fetch_Data").html(data.search_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Delete_Posts(valueUserId) {
            $.ajax({
                type: "POST",
                url: "/posts/" + valueUserId + "/destroy",
                data: {
                    dashData: "delete_Data",
                    _token: "{{ csrf_token() }}",
                    value: "EditPost",
                    id: valueUserId,
                },
                dataType: "json",
                success: function (data) {
                    console.log(data.success);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }
        static dahsboard_New_Post() {
            $.ajax({
                type: "POST",
                url: "posts/new",
                data: {
                    dashData: "load_Data",
                    _token: "{{ csrf_token() }}",
                    value: "NewPost",
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#ajax_Fetch_Data").html(data.Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Store(inputData) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: "posts/store",
                data: inputData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log("Created");
                    $("#dash_Area").append(data.responseAlert);
                    setTimeout(function () {
                        $("#success").remove();
                    }, 3500);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Edit_View(valueUserId) {
            $.ajax({
                type: "POST",
                url: "/posts/" + valueUserId + "/edit",
                data: {
                    dashData: "load_Data",
                    _token: "{{ csrf_token() }}",
                    value: "EditPost",
                    id: valueUserId,
                },
                dataType: "json",
                success: function (data) {
                    console.log(true);
                    $("#ajax_Fetch_Data").html(data.Edit_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Update_Post(inputData,post_id) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: "posts/" + post_id + "/update",
                data: inputData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data.test);
                    $("#body_Content_Dashboard").append(data.responseAlert);
                    setTimeout(function () {
                        $('#success').remove();
                    }, 3500);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Loader(){
            $(document).on({
              ajaxStop: function() { 
                $('#loader').delay(200).fadeOut( function () {
                    $(this).addClass('d-none');
                })
            }    
            });
        }
    }

    // dahsboard_NavLink_Active
        $(document).ready(function() {
            $(".sidanav_link").first().addClass("active");
            $(".sidanav_link").click(function () {
            $(".sidanav_link").removeClass("active");
                $(this).addClass("active");   
                $('#loader').removeClass('d-none')
            });

            $(document).on("click", "#toggleEdit", function () {
                $('#loader').removeClass('d-none');
            });
        });

        $(document).ready(function() {
            $(".dropdown-item").click(function () {
            $(".dropdown-item").removeClass("active");
            $(this).addClass("active");   
            $('#loader').removeClass('d-none')
            });
        });

    $(document).ready(function () {


        // DASHBOARD HOME
        $(".toggleDashboardHome").click(function (e) {
            e.preventDefault();
            console.log("toggle_Dashboard_Home");
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Home();
        });

        // ALL POSTS
        $(".toggleMyPost").click(function (e) {
            e.preventDefault();
            console.log("toggle_My_Post");
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Fetch_All_Posts();
        });

        // SEARCH POST
        $("#toggleSearchPost").click(function (e) {
            e.preventDefault();
            var val = $("#serach_String").val();
            if(val == ''){
                alert('Please Write The Post Title !')
                return
            }
            $(document).on({
              ajaxStart: function() { 
                $('#loader').removeClass('d-none');
              }
            });
            ajaxRequest.dahsboard_Loader();
            console.log("Search");
            ajaxRequest.dahsboard_Search_Posts(val);
        });

        // SELECT ALL VIA CHECKBOX //
        $(document).on("click", "#check_All", function () {
            if ($("#check_All").is(":checked")) {
                var checkValue = true;
                console.log(checkValue);
                $(".check_One").prop("checked", true);
            } else {
                var checkValue = false;
                console.log(checkValue);
                $(".check_One").prop("checked", false);
            }
        });

        // DELETE
        $(document).on("click", ".delete_This_Post", function (e) {
            e.preventDefault();
            var valueUserId = $(this).closest("tr").attr("data-id");
            $(this).closest("tr").remove();
            console.log("Delete");
            ajaxRequest.dahsboard_Delete_Posts(valueUserId);
        });



        // NEW AND STORE

        $(".toggleNewPost").click(function (e) {
            e.preventDefault();
            console.log("toggleNewPost");
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_New_Post();
        });

        $(document).on("submit", ".postsFormNew", function (event) {
            event.preventDefault();
            var formUpdate = {
                category_Menu: $("#category_Menu").val(),
                title: $("#title").val(),
                content: $("#content").val(),
                users_id: $("#users_id").val(),
            };
            var file = $("#upload").prop("files")[0];
            let inputData = new FormData($("#posts_Form_New")[0]);
            inputData.append("requestType", "New");
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Store(inputData);
            setTimeout(function() {
            ajaxRequest.dahsboard_Fetch_All_Posts();
            $('#toggleMyPost').addClass("active");   
            }, 1000);
        });

        // EDIT AND UPDATE
        $(document).on("click", ".edit_This_Post", function (e) {
            e.preventDefault();
            console.log("Edit");
            var valueUserId = $(this).closest("tr").attr("data-id");
            console.log(valueUserId);
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Edit_View(valueUserId);
        });

        $(document).on("submit", ".postsFormUpdate", function (event) {
            event.preventDefault();
            var formUpdate = {
                category_Menu: $("#category_Menu").val(),
                title: $("#title").val(),
                content: $("#content").val(),
                users_id: $("#users_id").val(),
                post_id: $("#posts_Form_Update").attr("data-id"),
            };
            var file = $("#upload").prop("files")[0];
            let inputData = new FormData($("#posts_Form_Update")[0]);
            inputData.append(
                "posts_id",
                $("#posts_Form_Update").attr("data-id")
            );
            inputData.append("requestType", "Update");
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Update_Post(inputData,formUpdate.post_id);
            setTimeout(function() {
                ajaxRequest.dahsboard_Fetch_All_Posts();
                $('#toggleMyPost').addClass("active");   
            }, 1000);
            
        });
    });
</script>
