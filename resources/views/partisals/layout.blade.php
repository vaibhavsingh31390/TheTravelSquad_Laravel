<?php
use App\Models\Category;
$CAT = Category::pluck('category_Menu');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/main.css') }}">
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('jquery.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/f65829aefc.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
                <a class="navbar-brand" href="{{ route('home.index') }}">
                The Travel Squad</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars" style="font-size:24px;"></i>
                    </span>
                </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                </li>

                @foreach ($CAT as $category)
                <?php 
                $menuItem[] = $category;
                $menuItems = array_unique($menuItem);
                ?>
                @endforeach

                @foreach ($menuItems as $key)
       

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('postByCategory', ['category' => $key]) }}">{{ $key }} </a>
                </li>
                @endforeach
                @guest
                <li class="nav-item admin_Btn">
                    <a class="nav-link" href="{{ route('login') }}">Log In</a>
                </li>
                @else
                <li class="nav-item admin_Btn">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                    @csrf
                </form>
                @endguest

            </ul>
          </div>
        </div>
    </nav>

    <section>
        @yield('section')
    </section>
    <script src="{{ mix('/js/main.js') }}"></script>
    
</body>
</html>