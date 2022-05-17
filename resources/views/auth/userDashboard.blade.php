@extends('partisals.layout')
@section('title', 'Dashboard - The Travel Squad')

@section('section')
    @include('partisals.layoutDashboard')
@endsection

@section('script')
<script src="{{ mix('/js/main.js') }}"></script>
@endsection