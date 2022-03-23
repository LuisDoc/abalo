@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Homepage</h1>
        <!-- Anzeigen der drei neusten Artikel -->
        <h3>Latest articles</h3>
        <!-- Tabelle für Artikel importieren -->
        @include('layout imports.articleTable')
        <a href="/articles" class="defaultButton">Show More articles</a>


    </div>
@endsection
