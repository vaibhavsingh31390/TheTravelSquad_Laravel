{{-- $findPosts for user Posts details --}}
{{-- $userProfile for user details --}}

<?php 
function set_active($path, $active = 'active') {
return call_user_func_array('Request::is', (array)$path) ? $active : '';

}
?>

<div class="container-fluid dashArea">
    <div class="row">
        <div class="col-lg-2 col-md-2 side-Nav">
            <div class="user_Data d-flex justify-content-start align-items-center mt-3">
                <div class="user_DataPhoto">
                <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61" alt="user_Photo">
                </div>
                <div class="userDataName ms-2">
                <p>
                    {{ $findPosts['profile']->name }}
                </p>
                </div>
            </div>
            <div class="side-Navigation mt-4">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ set_active(['userDashboard']) }}" href="{{ route('user.Dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ set_active(['userDashboard/myPosts']) }}" href="{{ route('user.Dashboard', ['action'=>'myPosts']) }}">My Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ set_active(['userDashboard/newPosts']) }}" href="{{ route('user.Dashboard', ['action'=>'newPosts']) }}">New Posts</a>
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
        <div class="col-lg-10 dashData p-0">
            <div class="col-lg-12 col-md-12 col-sm-12 p-3">
                <nav class="navbar navbar-expand-sm">
                    <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fas fa-bars" style="font-size:24px;"></i>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <form class="d-flex w-50" method="GET" action="{{ route('user.Dashboard', ['action'=>'search']) }}">
                        <input class="form-control me-2" name="search_Query" type="search" placeholder="Search Posts.." required>
                        <button class="btn btn-search" type="submit">Search</button>
                        </form>
                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                        </li>
                        {{-- HIDDEN NAV ACTION FOR MOBILE --}}
                        <li class="nav-item dropdown actionNav_Responsive" id="dropdownCategory">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Features
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li class="dropdown-item">
                            <a class="nav-link" aria-current="page"
                            href="{{ route('user.Dashboard', ['action'=>'myPosts']) }}">My Posts</a>
                            </li>
                            <li class="dropdown-item">
                            <a class="nav-link"
                            href="{{ route('user.Dashboard', ['action'=>'newPosts']) }}">New
                            Posts</a>
                            </li>
                            <li class="dropdown-item">
                            <a class="nav-link" href="#">Total Likes</a>
                            </li>
                            </ul>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li>
                                <a class="dropdown-item accountAction"
                                    href="{{ route('user.Dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item accountAction" href="{{ route('user.Dashboard') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log
                                    Out</a>
                            </li>
                            <li>
                                <a class="dropdown-item accountAction"
                                    href="{{ route('user.Dashboard') }}">Help</a>
                            </li>
                            </ul>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="post"
                            style="display: none">
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
            {{-- TOP NAV --}}
            @if (Request::is('userDashboard/myPosts'))
            <div class="col-lg-12 col-md-12 col-sm-12 px-3 dataSection">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 2%" scope="col">
                                    <form action="post">
                                        @csrf
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
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
                            @forelse ($findPosts['findIt'] as $data)
                            <tr data-id="{{ $data->id }}">
                                <th style="width: 2%" scope="col">
                                    <form action="post">
                                        @csrf
                                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                                            data-id="{{ $data->id }}">
                                    </form>
                                </th>
                                <th class="text-center" style="width: 3%" scope="row">{{ $data->id }}</th>
                                <td style="width: 20%">{{ $data->title }}</td>
                                <td style="width: 40%">{{ Str::of($data->content)->words(20) }}</td>
                                <td style="width: 15%">
                                    <select data-id="{{ $data->id }}" class="form-select"
                                        aria-label="Default select example">
                                        <option selected value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button data-id="{{ $data->id }}" type="button"
                                        class="btn btn-Dashboard">Edit</button>
                                    <button data-id="{{ $data->id }}" type="button"
                                        class="btn btn-Dashboard ms-4">Delete</button>
                                </td>
                            <tr>
                                @empty
                            <tr>
                                <th>
                                    <h1>Create Your Very First Post <a href="{{ route('#') }}"></a></h1>
                                </th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- DATA SECTION ALL Posts --}}
            @elseif (Request::is('userDashboard/newPosts'))
            <div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost">
                <div class="content_wrapper p-3">
                    <h2>New Post</h2>
                    <form action="#" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="Title" class="form-label">Title</label>
                            <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="title" name="Title">
                        </div>
                        <div class="mb-3">
                            <label for="Textarea1" class="form-label">Content</label>
                            <textarea class="form-control" name="Textarea1" id="Textarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Title" class="form-label">Image (url/hosted links only)</label>
                            <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="title" name="Title">
                        </div>
                        <div class="mb-3">
                            <label for="Status" class="form-label">Status</label>
                            <select data-id="temp" class="form-select" name="Status">
                                <option selected value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-search w-25">Save</button>
                    </form>
                </div>
            </div>
            {{-- NEW POST ADD Posts --}}
            @elseif (Request::is('userDashboard/search'))
            <div class="col-lg-12 col-md-12 col-sm-12 px-3 dataSection findPosts">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 2%" scope="col">
                                    <form action="post">
                                        @csrf
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
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
                            @forelse ($findPosts['findIt'] as $findPost)
                            <tr data-id="{{ $findPost->id }}">
                                <th style="width: 2%" scope="col">
                                    <form action="post">
                                        @csrf
                                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                                            data-id="{{ $findPost->id }}">
                                    </form>
                                </th>
                                <th class="text-center" style="width: 3%" scope="row">{{ $findPost->id }}</th>
                                <td style="width: 20%">{{ $findPost->title }}</td>
                                <td style="width: 40%">{{ Str::of($findPost->content)->words(20) }}</td>
                                <td style="width: 15%">
                                    <select data-id="{{ $findPost->id }}" class="form-select"
                                        aria-label="Default select example">
                                        <option selected value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button data-id="{{ $findPost->id }}" type="button"
                                        class="btn btn-Dashboard">Edit</button>
                                    <button data-id="{{ $findPost->id }}" type="button"
                                        class="btn btn-Dashboard ms-4">Delete</button>
                                </td>
                            <tr>
                                @empty
                            <tr>
                                <th>
                                    <h1 class="text-center">No Posts found. <a href="{{ route('user.Dashboard', ['action'=>'newPosts']) }}">Create One!</a></h1>
                                </th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- SEARCHED Posts --}}
            @else
            <div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost">
                <div class="content_wrapper p-3">
                    <h1>Welcome To the DashBoard</h1>
                </div>
            </div>
            {{-- DASHBOARD HOME PAGE --}}
            @endif
        </div>
        {{-- DASHDATA END --}}
    </div>
    {{-- DASHAREA ROW END --}}
</div>
{{-- DASHAREA END --}}