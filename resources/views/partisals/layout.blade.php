<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>@yield('title')</title>
@include('components.seo')
<link rel="icon" type="image/x-icon" href="{{ URL::to('/') }}/assets/favicon.ico">
<script>
(function () {
    var key = 'tts-theme';
    var saved = localStorage.getItem(key);
    var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    document.documentElement.setAttribute('data-theme', saved || (prefersDark ? 'dark' : 'light'));
    document.documentElement.setAttribute('data-bs-theme', saved || (prefersDark ? 'dark' : 'light'));
})();
</script>
<link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
<link rel="stylesheet" href="{{ mix('/css/main.css') }}" />
<script src="{{ mix('/js/app.js') }}" defer></script>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@if (Route::is('user.Dashboard'))
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.min.js"></script>
@include('components.dashboard.dashBoard_Scripts')
@else
@include('components._scripts')
@endif
</head>

<body>
@if (Route::is('user.Dashboard'))
<header class="dash-header-bar">
<a href="{{ route('home.index') }}" class="dash-logo">The Travel Squad</a>
<div class="dash-header-actions">
<button type="button" class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
<i class='bx bx-moon' id="theme-icon"></i>
</button>
<a href="{{ route('home.index') }}" class="btn-pill-outline btn-sm">View Site</a>
</div>
</header>
<section class="body_ContentDashboard" id="body_Content_Dashboard">@yield('section')</section>
@else
<nav class="navbar fixed-top navbar-expand-lg site-nav">
<div class="container position-relative">
<a class="navbar-brand" href="{{ route('home.index') }}">The Travel Squad</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"><i class='bx bx-menu' id="toggle" style="font-size: 22px"></i></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav navbar-nav-center mx-lg-auto mb-2 mb-lg-0">
<li class="nav-item"><a class="nav-link {{ Route::is('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">Home</a></li>
<li class="nav-item"><a class="nav-link {{ Route::is('posts.index') ? 'active' : '' }}" href="{{ route('posts.index') }}">Articles</a></li>
<li class="nav-item dropdown" id="dropdownCategory">
<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categories</a>
<ul class="dropdown-menu">
<li class="dropdown-item {{ Route::is('posts.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('posts.index') }}">All Posts</a></li>
@foreach ($category->unique() as $key)
<li class="dropdown-item {{ request()->is("type/$key") ? 'active' : '' }}"><a class="nav-link" href="{{ route('postByCategory', ['category' => $key]) }}">{{ $key }}</a></li>
@endforeach
</ul>
</li>
<li class="nav-item"><a class="nav-link {{ Route::is('pages.about') ? 'active' : '' }}" href="{{ route('pages.about') }}">About</a></li>
</ul>

<ul class="navbar-nav ms-lg-auto align-items-lg-center gap-lg-2">
<li class="nav-item">
<button type="button" class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
<i class='bx bx-moon' id="theme-icon"></i>
</button>
</li>
@guest
<li class="nav-item admin_Btn"><a class="nav-link" href="{{ route('login') }}">Sign in</a></li>
@else
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Account</a>
<ul class="dropdown-menu dropdown-menu-end">
<li><a class="dropdown-item accountAction" href="{{ route('user.Dashboard') }}">Dashboard</a></li>
<li><a class="dropdown-item accountAction" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a></li>
</ul>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">@csrf</form>
@endguest
</ul>
</div>
</div>
</nav>

<section class="body_Content">@yield('section')</section>

<footer class="site-footer">
<div class="container">
<div class="row g-4">
<div class="col-lg-4">
<div class="footer-brand">The Travel Squad</div>
<p>Stories worth the journey — travel tips and adventures from our community.</p>
</div>
<div class="col-6 col-lg-2">
<div class="footer-heading">Resources</div>
<ul class="footer-links">
<li><a href="{{ route('home.index') }}">Home</a></li>
<li><a href="{{ route('posts.index') }}">Articles</a></li>
<li><a href="{{ route('login') }}">Sign in</a></li>
</ul>
</div>
<div class="col-6 col-lg-2">
<div class="footer-heading">Categories</div>
<ul class="footer-links">
@foreach ($category->unique()->take(5) as $key)
<li><a href="{{ route('postByCategory', ['category' => $key]) }}">{{ $key }}</a></li>
@endforeach
</ul>
</div>
<div class="col-6 col-lg-2">
<div class="footer-heading">Popular Tags</div>
<ul class="footer-links footer-tags">
@foreach ($popularTags->take(6) as $tag)
<li><a href="{{ route('postByTag', ['tag' => $tag->slug]) }}">#{{ $tag->name }}</a></li>
@endforeach
</ul>
</div>
<div class="col-6 col-lg-2">
<div class="footer-heading">Company</div>
<ul class="footer-links">
<li><a href="{{ route('pages.about') }}">About</a></li>
<li><a href="{{ route('pages.contact') }}">Contact</a></li>
<li><a href="{{ route('pages.privacy') }}">Privacy Policy</a></li>
<li><a href="{{ route('pages.terms') }}">Terms of Service</a></li>
</ul>
</div>
</div>
<div class="footer-bottom">
<div class="d-flex flex-wrap justify-content-between gap-2">
<span>&copy; {{ date('Y') }} The Travel Squad. All rights reserved.</span>
<span><a href="{{ route('pages.privacy') }}">Privacy Policy</a> &middot; <a href="{{ route('pages.terms') }}">Terms of Service</a></span>
</div>
<p class="footer-credit">Developed by <a href="https://heyvai.dev" target="_blank" rel="noopener noreferrer">Vaibhav Singh</a></p>
</div>
</div>
</footer>

@include('components.alert')
<div class="d-flex justify-content-center align-items-center mb-2 loader_Bottom d-none" id="loader">
<span><img class="response_Bottom_Loader" src="{{ URL::to('/') }}/assets/loader_Bottom.gif" alt="Loading"></span>
</div>
@endif
<script src="{{ mix('/js/main.js') }}"></script>
</body>
</html>
