@extends('tailwind.layouts.app')
@section('content')
    <div class="bg-cgray">
        <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
            Alle Artikel im Überblick
        </div>
        <!-- Anzeige aller Inserate -->
        @include('tailwind.layouts.viewArticles')
    </div>
    <!-- Tabellenvariante?
                        <div class="bg-cgray">
                                <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
                                    Alle Artikel im Überblick
                                </div>
                                <div class=" p-64 pt-20">
                                    <table>
                                        <thead>
                                            <td scope="col">Bild</td>
                                            <td scope="col">Name</td>
                                            <td scope="col">Beschreibung</td>
                                            <td scope="col">Ersteller</td>
                                            <td scope="col">Datum</td>
                                        </thead>
                                        <tbody>
                                            @foreach ($articles as $article)
    <tr class="border border-black">
                                                    <td>
                                                        @if (file_exists(public_path() . '/images/articlepictures/' . $article->id . '.jpg'))
    <img class="border border-black"src="{{ url('/images/articlepictures/' . $article->id . '.jpg') }}" alt="">
@else
    <img class="border border-black"src="{{ url('/images/articlepictures/' . $article->id . '.png') }}" alt="">
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
                            </div>
                        -->
@endsection
