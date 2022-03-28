@extends('tailwind.layouts.app')
@section('content')
    <!--Main Content-->
    <div class="relative">
        <div style="background-image: url('{{ asset('images/shop.jpg') }}'); height:857px"></div>
        <div class="shade"></div>
        <div class="absolute top-28 left-56">
            <div class="text-purple text-5xl headline w-64">
                ABALO - Der beste Gebrauchtwarenhändler
            </div>
            <div class="text-purple text-2xl mt-4 headline">
                Entdecke die große Auswahl an Produkten hier bei Abalo
            </div>
            <a class="mt-6 py-4 px-8 pr-2 btn block w-36" href="/articles">
                Entdecken
            </a>
        </div>
    </div>
    <!--Latest 3 articles-->
    <div class="bg-cgray">
        <div class="text-5xl headline ml-64 pt-20 mb-20 text-purple">
            Neuste Artikel
        </div>
        <!-- Anzeigen der drei zuletzt hinzugefügten Artikel -->
        @include('tailwind.layouts.viewArticles')
    </div>
@endsection
@section('scripts')
    <script>
        const wrapper = document.querySelector(".shade");
        wrapper.addEventListener('click', (e) => {
            searchbar.classList.remove('block');
            searchbar.classList.add('hidden');
        })
    </script>
@endsection
