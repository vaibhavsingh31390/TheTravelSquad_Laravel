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

    {{-- <div class="container-fluid d-flex justify-content-center align-items-center alert_Overlay_Container d-none" id="success">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 alert_Overlay">
                <div>
                    <h3 class="d-flex align-items-center p-2 mb-0">
                        <i class='bx bx-info-circle me-2'></i>
                        <span>Information !</span>
                    </h3>
                </div>
                <div class="px-2 py-3">
                    <h5 class="p-1 text-center">
                        <span>{{ $message ?? '' }}</span>
                    </h5>
                    <span>
                        <img class="response_Image" src="{{ URL::to('/') }}/assets/success.gif">
                    </span>
                </div>

            </div>
        </div>
    </div>
</div> --}}
{{-- DASHAREA END --}}
