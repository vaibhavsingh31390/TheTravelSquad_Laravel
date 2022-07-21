<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>@yield('title')</title>
<link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
<link rel="stylesheet" href="{{ mix('/css/main.css') }}" />
<script src="{{ mix('/js/app.js') }}" defer></script>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@if (Route::is('user.Dashboard'))
<meta name="csrf-token" content="{{ csrf_token() }}" />
@include('components.dashboard.dashBoard_Scripts')
@else
@include('components._scripts')
@endif
</head>

<body>
@if (Route::is('user.Dashboard'))
<section class="body_ContentDashboard">@yield('section')</section>
@else
<nav class="navbar fixed-top navbar-expand-lg">
<div class="container">
<a class="navbar-brand" href="{{ route('home.index') }}">
The Travel Squad</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon">
<i class='bx bx-menu'  id="toggle" style="font-size: 24px"></i>
</span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link {{ Route::is('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">Home</a>
</li>
<li class="nav-item dropdown" id="dropdownCategory">
<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
Categories
</a>
<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
<li class="dropdown-item  {{ Route::is('posts.index') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('posts.index') }}">All Posts</a>
</li>
@foreach ($category->unique() as $key)
<li class="dropdown-item  {{ request()->is("type/$key") ? 'active' : '' }}">
<a class="nav-link" href="{{ route('postByCategory', ['category' => $key]) }}">{{ $key }}
</a>
</li>
@endforeach
</ul>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ route('home.index') }}">About Us</a>
</li>
@guest
<li class="nav-item admin_Btn">
<a class="nav-link" href="{{ route('login') }}">Log In</a>
</li>
@else
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
Account
</a>
<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
<li>
<a class="dropdown-item accountAction" href="{{ route('user.Dashboard') }}">Dashboard</a>
</li>
<li>
<a class="dropdown-item accountAction" href="{{ route('user.Dashboard') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
</li>
<li>
<a class="dropdown-item accountAction" href="{{ route('user.Dashboard') }}">Help</a>
</li>
</ul>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
@csrf
</form>
@endguest
</ul>
</div>
</div>
</nav>
<section class="body_Content">@yield('section')</section>
@endif
<script src="{{ mix('/js/main.js') }}"></script>
</body>
</html>