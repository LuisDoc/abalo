@extends('tailwind.layouts.app')
@section('content')
    <div class="bg-cgray">
        <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
            {{$headline}}
        </div>
        <!-- Anzeige aller Inserate -->
        @include('tailwind.layouts.viewArticles')
    </div>
@endsection
