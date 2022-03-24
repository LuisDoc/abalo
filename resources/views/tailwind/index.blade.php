@extends('tailwind.layouts.app')
@section('content')
    <!--Main Content-->
  <div class="relative">
      <div style="background-image: url('{{ asset('images/shop.jpg')}}'); height:857px"></div>
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
        <div class="mt-20 pb-24">
            
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 p-64 pt-0 pb-24 gap-4">
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
            <a href="/articles" class="btn ml-64 py-4 px-8">Mehr Artikel ansehen</a>
        </div>
    </div>
@endsection
@section('scripts')
<script>
     const wrapper=document.querySelector(".shade");
     wrapper.addEventListener('click', (e)=>{
          searchbar.classList.remove('block');
          searchbar.classList.add('hidden');
      })
</script>
@endsection
