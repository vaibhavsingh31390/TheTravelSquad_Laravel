<script type="text/javascript">
    $(document).ready(function () {
        // DASHBOARD HOME
        $(".toggleDashboardHome").click(function (e) {
            e.preventDefault();
            console.log('toggleDashboardHome');
            $.ajax({
                type: "POST",
                url: "/dashHome",
                data: { dashData: 'load_Data', _token: "{{ csrf_token() }}", value:"Home"},
                dataType: "json",
                success: function (data) {
                    console.log(data);
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
                data: { load_Data: 'load_Data', _token: "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    console.log(data);
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
                data: { load_Data: 'load_Data', value: val,  _token: "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    console.log(data);
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
                data: { dashData: 'load_Data', _token: "{{ csrf_token() }}", value:"NewPost"},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#ajax_Fetch_Data').html(data.Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log('error');
                },
            });
        });
        // EDIT POST
        $("#delete_edit_Form").submit(function(e) {
            e.preventDefault();
            console.log('form submit Clicked');
        });
        $("#toggleSearchPost").click(function (e) {
            e.preventDefault();
            console.log('serach');

        });
        $("#delete_This_Post").click(function (e) {
            e.preventDefault();
            console.log('delete_This_Post');
        });
    });
</script>