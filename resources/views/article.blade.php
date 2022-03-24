@extends('layouts.app')
@section('content')
    <div class="container">
<!---->
        <div class="search">
            <form action="/articles/search" method=" GET">
                <input name="search" type="search" placeholder="Search" aria-label="Search">
                <input value="Search" type="submit">
            </form>
        </div>
        @include('layout imports.articleTable')
    </div>
@endsection
