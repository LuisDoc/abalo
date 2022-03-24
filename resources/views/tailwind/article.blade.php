@extends('tailwind.layouts.app')
@section('content')
    <div class="bg-cgray">
        <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
            Alle Artikel im Überblick
        </div>
        <div class="mt-20">
            
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 p-64 pt-0  gap-4">
                @foreach($articles as $article)
                    <a href="" class="col-span-1 bg-white hover:shadow-lg transition ease-in-out">
                        <div class="p-4">
                            <h1 class="headline font-bold mb-2 truncate text-purple">{{ $article->ab_name }}</h1>
                            <p class="text-sm mt-4 text-purple font-semibold mb-1">{{ $article->ab_preis }}</p>
                            <p class="text-sm text-gray-600 mb-1 truncate">{{ $article->ab_description }}</p>
                            <p class="text-sm text-gray-600 mb-1">Creator: {{ $article->ab_creator_id }}</p>
                            <p class="text-sm text-gray-500 mb-1">{{ $article->ab_createdate }}</p>
                            @if (file_exists(public_path() . '/images/articlepictures/' . $article->id . '.jpg'))
                                <img src="{{ url('/images/articlepictures/' . $article->id . '.jpg') }}" alt="" class="w-full h-60 object-cover mt-5">
                            @else
                                <img src="{{ url('/images/articlepictures/' . $article->id . '.png') }}" alt="" class="w-full h-60 object-cover mt-5">
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
