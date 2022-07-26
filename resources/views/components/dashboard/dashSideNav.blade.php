<div class="col-lg-2 col-md-2 side-Nav">
<div class="user_Data d-flex justify-content-start align-items-center mt-3">
<div class="user_DataPhoto">
<img src="{{ auth()->user()->media->url() }}" alt="user_Photo">
</div>
<div class="userDataName ms-2">
<p>
{{ $authenticated_User->name}}
</p>
</div>
</div>
<div class="side-Navigation mt-4">
<ul class="nav flex-column">
<li class="nav-item">
<a class="nav-link toggleDashboardHome sidanav_link" href="#" id="toggleDashboardHome">Dashboard</a>
</li>
<li class="nav-item">
<a class="nav-link toggleMyPost sidanav_link" href="#" id="toggleMyPost">My Posts</a>
</li>
<li class="nav-item">
<a class="nav-link toggleNewPost sidanav_link" href="#" id="toggleNewPost">New Posts</a>
</li>
<li class="nav-item">
<a class="nav-link sidanav_link" href="#">Total Likes</a>
</li>
<li class="nav-item">
<a class="nav-link sidanav_link" href="#">Customer Care</a>
</li>
</ul>
</div>
</div>
{{-- SIDENAV --}}
