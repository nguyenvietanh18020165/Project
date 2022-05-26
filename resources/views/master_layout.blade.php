@extends('layouts.home_layout')
@section('title')
    {{$title}}
@endsection
@section('content')
    @foreach ($pages as $item)
        @include($item)
    @endforeach
@endsection
