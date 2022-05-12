{{-- $userData for user details --}}
<div class="container-fluid dashArea">
    <div class="row">
        <div class="col-lg-2 side-Nav">
            <div class="user_Data d-flex justify-content-start align-items-center mt-3">
                <div class="user_DataPhoto">
                    <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61" alt="user_Photo">
                </div>
                <div class="userDataName ms-2">
                    <p>
                        {{ $userData->name }}
                    </p>
                </div>
            </div>
            <div class="side-Navigation mt-4">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('user.Dashboard', ['action'=>'myPosts']) }}">My Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.Dashboard', ['action'=>'newPosts']) }}">New Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Likes</a>
                    </li>
                    <li class="nav-item"></li>
                        <a class="nav-link" href="#">Customer Care</a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- SIDENAV --}}
        <div class="col-lg-10 dashData p-0">
            <div class="col-lg-12 col-md-12 col-sm-12 p-3">
                <nav class="navbar navbar-expand-lg">
                    <div class="container">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon">
                                    <i class="fas fa-bars" style="font-size:24px;"></i>
                                </span>
                            </button>
                      <div class="collapse navbar-collapse" id="navbarNav">
                        <form class="d-flex w-50">
                            @csrf
                            <input class="form-control me-2" type="search" placeholder="Search Posts.."
                                aria-label="Search" required>
                            <button class="btn btn-search" type="submit">Search</button>
                        </form>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                            </li>
                
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
                        </ul>
                      </div>
                    </div>
                </nav>
            </div>
            {{-- TOP NAV --}}

            <div class="col-lg-12 col-md-12 col-sm-12 px-3 dataSection">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 2%" scope="col">
                            <form action="post">
                                @csrf
                                <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                            </form>
                            </th>
                            <th style="width: 3%" scope="col" class="text-center">#</th>
                            <th style="width: 20%" scope="col">Title</th>
                            <th style="width: 40%" scope="col">Content</th>
                            <th style="width: 15%" scope="col">Status</th>
                            <th style="width: 20%" scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                      <tbody>
                          @for ($i=0;$i<=15;$i++)
                          <tr>
                        <th style="width: 2%" scope="col">
                            <form action="post">
                                @csrf
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                            </form>
                            </th>
                          <th class="text-center" style="width: 3%" scope="row">{{ $i }}</th>
                          <td style="width: 20%">Lorem ipsum dolor sit amet.</td>
                          <td style="width: 40%"></td>
                          <td style="width: 15%">
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                          </td>
                          <td  class="d-flex justify-content-around">
                              <button type="button" class="btn btn-Dashboard ms-4">Edit</button>
                              <button type="button" class="btn btn-Dashboard">Delete</button>
                          </td>
                          <tr>
                          @endfor 
                      </tbody>
                    </table>
                  </div>
            </div>
            {{-- DATA SECTION ALL Posts --}}

            {{-- FILTER --}}
        </div>
        {{-- ALL POSTS --}}
    </div>
</div>