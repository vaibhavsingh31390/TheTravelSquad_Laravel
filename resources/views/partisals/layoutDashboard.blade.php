{{-- $findPosts for user Posts details --}}
{{-- $userProfile for user details --}}
<div class="container-fluid dashArea" id="dash_Area">
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
@include('components.alert')
<div class="d-flex justify-content-center align-items-center loader d-none" id="loader">
<div class="spinner-border spinner" role="status" style="">
<span class="sr-only">Loading...</span>
</div>
</div>

{{-- DASHAREA END --}}
