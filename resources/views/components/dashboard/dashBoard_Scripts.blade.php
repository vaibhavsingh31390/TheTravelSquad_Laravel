<script type="text/javascript">
    // CUSTOM NODAL
    // function async nodal(){
    //     $(document).on('click','.responseButton', function () {
    //         var responseValue = $(this).attr('data-id');
    //         if(responseValue=="true"){
    //             return responseValue;
    //         }
    //         $('.alert_Overlay_Container').remove()
    //         return false;
    //     });
    // }
    // var x = nodal();
    // setTimeout(() => {
    //     console.log(x);
    // }, 800);


    $(document).ready(function () {
        // DASHBOARD HOME
        $(".toggleDashboardHome").click(function (e) {
            e.preventDefault();
            console.log('toggleDashboardHome');
            $.ajax({
                type: "POST",
                url: "/dashHome",
                data: { dashData: 'load_Data', _token: "{{ csrf_token() }}", value: "Home" },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $('#ajax_Fetch_Data').html(data.Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });
        // ALL POSTS

        $(".toggleMyPost").click(function (e) {
            e.preventDefault();
            console.log('toggleMyPost');
            $.ajax({
                type: "POST",
                url: "/userDashboard/myPosts",
                data: { load_Data: 'load_Data', _token: "{{ csrf_token() }}" },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $('#ajax_Fetch_Data').html(data.all_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });

        // SEARCH POST
        $("#toggleSearchPost").click(function (e) {
            e.preventDefault();
            var val = $('#serach_String').val();
            console.log('serach');
            $.ajax({
                type: "POST",
                url: "/userDashboard/search'",
                data: { load_Data: 'load_Data', value: val, _token: "{{ csrf_token() }}" },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $('#ajax_Fetch_Data').html(data.search_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });
        // NEW POST
        $(".toggleNewPost").click(function (e) {
            e.preventDefault();
            console.log('toggleNewPost');
            $.ajax({
                type: "POST",
                url: "/dashHome",
                data: { dashData: 'load_Data', _token: "{{ csrf_token() }}", value: "NewPost" },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $('#ajax_Fetch_Data').html(data.Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });

        // SELECT ALL VIA CHECKBOX //
        $(document).on('click', '#check_All', function () {
            if ($('#check_All').is(':checked')) {
                var checkValue = true;
                console.log(checkValue);
                $(".check_One").prop('checked', true);
            } else {
                var checkValue = false;
                console.log(checkValue);
                $(".check_One").prop('checked', false);
            };
        });

        // EDIT
        $(document).on('click', '.edit_This_Post', function (e) {
            e.preventDefault();
            console.log('Edit');
            var valueUserId = $(this).closest('tr').attr('data-id');
            console.log(valueUserId);
            $.ajax({
                type: "POST",
                url: "/posts/" + valueUserId + "/edit",
                data: { dashData: 'load_Data', _token: "{{ csrf_token() }}", value: "EditPost", id: valueUserId },
                dataType: "json",
                success: function (data) {
                    console.log(true);
                    $('#ajax_Fetch_Data').html(data.Edit_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });

        // DELETE
        $(document).on('click', '.delete_This_Post', function (e) {
            e.preventDefault();
            var valueUserId = $(this).closest('tr').attr('data-id');
            $(this).closest("tr").remove();
            console.log('Delete');
            console.log(valueUserId);
            $.ajax({
                type: "POST",
                url: "/posts/" + valueUserId + "/destroy",
                data: { dashData: 'delete_Data', _token: "{{ csrf_token() }}", value: "EditPost", id: valueUserId },
                dataType: "json",
                success: function (data) {
                    console.log(data.success);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Update Data
        $(document).on('submit', '.editProfile', function (event) {
            event.preventDefault();
            var form = {
                category_Menu: $('#category_Menu').val(),
                title: $('#title').val(),
                content: $('#content').val(),
                users_id: $('#users_id').val(),
                post_id: $('#editProfile').attr('data-id')
            }
            var file = $('#upload').prop('files')[0];
            let inputData = new FormData($('#editProfile')[0]);
            inputData.append('posts_id', $('#editProfile').attr('data-id'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'posts/' + form.post_id + '/update',
                data: inputData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data.formData);
                    alert('Updated');
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });
    });
</script>