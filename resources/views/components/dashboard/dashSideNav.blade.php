<div class="col-lg-2 col-md-2 side-Nav">
<div class="user_Data d-flex justify-content-start align-items-center mt-3">
<div class="user_DataPhoto">
<img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61" alt="user_Photo">
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
<a class="nav-link toggleDashboardHome" href="#" id="toggleDashboardHome">Dashboard</a>
</li>
<li class="nav-item">
<a class="nav-link toggleMyPost" href="#" id="toggleMyPost">My Posts</a>
</li>
<li class="nav-item">
<a class="nav-link toggleNewPost" href="#" id="toggleNewPost">New Posts</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Total Likes</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Customer Care</a>
</li>
</ul>
</div>
</div>
{{-- SIDENAV --}}
