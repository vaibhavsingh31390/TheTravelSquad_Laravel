{{-- $findPosts for user Posts details --}}
{{-- $userProfile for user details --}}
<?php 
function set_active($path, $active = 'active') {
return call_user_func_array('Request::is', (array)$path) ? $active : '';
}
?>

<div class="container-fluid dashArea">
    <div class="row">

        @sideNav
        @endsideNav

        <div class="col-lg-10 dashData p-0">
            @topNav
            @endtopNav
            {{-- TOP NAV --}}
            <div class="ajax_Fetch_Data" id="ajax_Fetch_Data">

                @if (Request::is('userDashboard/myPosts'))
                @dashTable(['findPosts'=>$findPosts])
                @enddashTable
                {{-- DATA SECTION ALL Posts [userDashboard/myPosts] --}}
    
                @elseif (Request::is('userDashboard/newPosts'))
                @dashNewPost
                @enddashNewPost
                {{-- NEW POST ADD Posts [userDashboard/newPosts]--}}
    
                @elseif (Request::is('userDashboard/search'))
                @dashSearchData(['findPosts'=>$findPosts])
                @enddashSearchData
                {{-- SEARCHED Posts [userDashboard/editPosts]--}}
    
                @elseif (Request::is('userDashboard/editPosts'))
                @dashEditPost
                @enddashEditPost
                {{-- Edit Posts [userDashboard/editPosts]--}}
    
                @else
                @dashHome
                @enddashHome
                {{-- DASHBOARD HOME PAGE --}}
                @endif

            </div>
        </div>
        {{-- DASHDATA END --}}
    </div>
    {{-- DASHAREA ROW END --}}
</div>
{{-- DASHAREA END --}}


<script>

    $(document).ready(function () {
        $("#toggleMyPost").click(function (e) {
            console.log('toggleMyPost');
            //   $(document).on({
            //       ajaxStart: function() { $("#load_More").text('Loading..');},
            //       ajaxStop: function() { $("#load_More").text('Load More'); }    
            //   });
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
        $("#toggleNewPost").click(function (e) {
            console.log('toggleNewPost');
        });
        $("#toggleDashboardHome").click(function (e) {
            console.log('toggleDashboardHome');
        });
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
    });


</script>