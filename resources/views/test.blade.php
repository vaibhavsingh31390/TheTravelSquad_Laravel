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
<?php
$test3 = "tested";
?>
@include('components._scripts')
@endif
</head>

<body>

@include('components.alert')
</body>
</html>