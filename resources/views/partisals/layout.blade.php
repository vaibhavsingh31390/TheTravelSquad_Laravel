<?php
use App\Models\Category;
// $CAT = Category::pluck('category_Menu')
$CAT = array('Technology','Travel', 'Food');;
?>
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
        <script
            src="https://kit.fontawesome.com/f65829aefc.js"
            crossorigin="anonymous"></script>
    </head>

    <body>
        @if (Route::is('user.Dashboard'))
        <section class="body_ContentDashboard">@yield('section')</section>
        @else
        <nav class="navbar fixed-top navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home.index') }}">
                    The Travel Squad</a
                >
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars" style="font-size: 24px"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">Home</a>
                        </li>
                        @foreach ($CAT as $category)
                        <?php 
                    $menuItem[] = $category;
                    $menuItems = array_unique($menuItem);
                ?>
                        @endforeach
                        <li class="nav-item dropdown" id="dropdownCategory">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarScrollingDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Categories
                            </a>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="navbarScrollingDropdown"
                            >
                                @foreach ($menuItems as $key)
                                <li class="dropdown-item">
                                    <a
                                        class="nav-link"
                                        href="{{ route('postByCategory', ['category' => $key]) }}"
                                        >{{ $key }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.index') }}"
                                >About Us</a
                            >
                        </li>
                        @guest
                        <li class="nav-item admin_Btn">
                            <a class="nav-link" href="{{ route('login') }}"
                                >Log In</a
                            >
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarScrollingDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Account
                            </a>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="navbarScrollingDropdown"
                            >
                                <li>
                                    <a
                                        class="dropdown-item accountAction"
                                        href="{{ route('user.Dashboard') }}"
                                        >Dashboard</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item accountAction"
                                        href="{{ route('user.Dashboard') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                        >Log Out</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item accountAction"
                                        href="{{ route('user.Dashboard') }}"
                                        >Help</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <form
                            id="logout-form"
                            action="{{ route('logout') }}"
                            method="post"
                            style="display: none"
                        >
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
        @yield('script')
    </body>
</html>
