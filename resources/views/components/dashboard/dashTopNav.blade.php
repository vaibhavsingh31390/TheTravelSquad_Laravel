<div class="col-12 dash-topbar">
<nav class="navbar navbar-expand-sm">
<div class="container-fluid px-0">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"><i class='bx bx-menu' id="toggle" style="font-size: 22px"></i></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<form class="d-flex flex-grow-1 me-3 dashboad_Search_Form" method="POST" action="{{ route('user.Dashboard', ['action'=>'search']) }}">
<input class="form-control me-2" name="search_Query" type="search" placeholder="Search posts..." id="serach_String" required>
<button class="btn btn-search" type="submit" id="toggleSearchPost">Search</button>
</form>
<ul class="navbar-nav ms-auto align-items-center">
<li class="nav-item dropdown actionNav_Responsive" id="dropdownCategory">
<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Menu</a>
<ul class="dropdown-menu dropdown-menu-end">
<li class="dropdown-item"><a class="nav-link toggleMyPost" href="#" id="toggleMyPost">My Posts</a></li>
<li class="dropdown-item"><a class="nav-link toggleNewPost" href="#" id="toggleNewPost">New Post</a></li>
</ul>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Account</a>
<ul class="dropdown-menu dropdown-menu-end">
<li><a class="dropdown-item accountAction toggleDashboardHome" href="#" id="toggleDashboardHome">Dashboard</a></li>
<li><a class="dropdown-item accountAction" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a></li>
</ul>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">@csrf</form>
<li class="nav-item actionNav_Responsive ms-2">
<div class="user_DataPhoto">
<img src="{{ auth()->user()->media?->url() ?? \App\Models\Media::placeholderAvatarUrl() }}" alt="user_Photo">
</div>
</li>
</ul>
</div>
</div>
</nav>
</div>
