@extends('partisals.layout')
@section('title', $cardsData[0]->category[0]->category_Menu.' Posts - The Travel Squad')
@section('section')
    @include('post.partials.postCards')
@endsection