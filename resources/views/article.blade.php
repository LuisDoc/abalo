@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="search">
            <form action="/articles/search" method=" GET">
                <input name="search" type="search" placeholder="Search" aria-label="Search">
                <input value="Search" type="submit">
            </form>
        </div>

        <table class="table">
            <thead>
                <td scope="col">Bild</td>
                <td scope="col">Name</td>
                <td scope="col">Beschreibung</td>
                <td scope="col">Ersteller</td>
                <td scope="col">Datum</td>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>
                            @if (file_exists(public_path() . '/images/articlepictures/' . $article->id . '.jpg'))
                                <img src="{{ url('/images/articlepictures/' . $article->id . '.jpg') }}" alt="">
                            @else
                                <img src="{{ url('/images/articlepictures/' . $article->id . '.png') }}" alt="">
                            @endif
                        </td>
                        <td>{{ $article->ab_name }}</td>
                        <td>{{ $article->ab_description }}</td>
                        <td>{{ $article->ab_creator_id }}</td>
                        <td>{{ $article->ab_createdate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
