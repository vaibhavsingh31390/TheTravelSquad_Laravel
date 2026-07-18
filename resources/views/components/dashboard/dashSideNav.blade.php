<div class="col-lg-2 col-md-2 side-Nav">
<div class="user_Data d-flex align-items-center">
<div class="user_DataPhoto">
<img src="{{ auth()->user()->media?->url() ?? \App\Models\Media::placeholderAvatarUrl() }}" alt="user_Photo">
</div>
<div class="userDataName ms-2">
<p>{{ $authenticated_User->name }}</p>
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
<a class="nav-link toggleNewPost sidanav_link" href="#" id="toggleNewPost">New Post</a>
</li>
<li class="nav-item">
<a class="nav-link toggleTotalLikes sidanav_link" href="#" id="toggleTotalLikes">Total Likes</a>
</li>
<li class="nav-item">
<a class="nav-link sidanav_link" href="#">Support</a>
</li>
</ul>
</div>
</div>
