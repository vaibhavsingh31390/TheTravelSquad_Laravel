<div class="col-lg-12 col-md-12 col-sm-12 p-3">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars" style="font-size:24px;"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex w-50" method="POST" action="{{ route('user.Dashboard', ['action'=>'search']) }}">
                    <input class="form-control me-2" name="search_Query" type="search" placeholder="Search Posts.." id="serach_String"
                        required>
                    <button class="btn btn-search" type="submit" id="toggleSearchPost">Search</button>
                </form>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                    </li>
                    {{-- HIDDEN NAV ACTION FOR MOBILE --}}
                    <li class="nav-item dropdown actionNav_Responsive" id="dropdownCategory">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Features
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li class="dropdown-item">
                                <a class="nav-link toggleMyPost"  aria-current="page" href="#" id="toggleMyPost">My Posts</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link toggleNewPost" href="#" id="toggleNewPost">New
                                    Posts</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="#">Total Likes</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li>
                                <a class="dropdown-item accountAction toggleDashboardHome" href="#" id="toggleDashboardHome">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item accountAction" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log
                                    Out</a>
                            </li>
                            {{-- <li>
                                <a class="dropdown-item accountAction" href="{{ route('user.Dashboard') }}">Help</a>
                            </li> --}}
                        </ul>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        @csrf
                    </form>
                    <li class="nav-item actionNav_Responsive">
                        <div class="user_DataPhoto">
                            <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61" alt="user_Photo">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    $(document).ready(function() {
        $(".dropdown-item").click(function () {
            $(".dropdown-item").removeClass("active");
            $(this).addClass("active");   
        });
    });
</script>