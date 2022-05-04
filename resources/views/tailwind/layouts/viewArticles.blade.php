<div class="mt-20">
    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 p-32 px-64 pt-1 gap-4">
        @foreach ($articles as $article)
            <!-- Artikel Anzeige-->
            <div class="class= bg-white hover:shadow-lg hover:outline hover:outline-purple transition ease-in-out">
                <a  href="">
                    <div class="p-4">
                        <h1 class="headline font-bold mb-2 truncate text-purple">{{ $article->ab_name }}</h1>
                        <p class="text-sm mt-4 text-gray-600 font-semibold mb-1"><b class="text-purple">Preis:</b> {{ $article->ab_price }}</p>
                        <p class="text-sm text-gray-600 mb-1 truncate"><b class="text-purple">About:</b>
                            {{ $article->ab_description }}</p>
                        <p class="text-sm text-gray-600 mb-1"><b class="text-purple">Creator:</b>
                            {{ $article->ab_creator_id }}</p>
                        <p class="text-sm text-gray-600 mb-1"><b class="text-purple">Created at:</b>
                            {{ $article->ab_createdate }}</p>
                        @if (file_exists(public_path() . '/images/articlepictures/' . $article->id . '.jpg'))
                            <img src="{{ url('/images/articlepictures/' . $article->id . '.jpg') }}" alt=""
                                class="w-full h-60 object-cover mt-5">
                        @else
                            <img src="{{ url('/images/articlepictures/' . $article->id . '.png') }}" alt=""
                                class="w-full h-60 object-cover mt-5">
                        @endif
                    </div>
                    @if(!Auth::guest())
                        <div class ="p-4 flex justify-end">
                            @if(Auth()->User()->id == $article->ab_creator_id)
                                    <a class ="w-14 h-15 rounded-full p-2 bg-white border-red-400 hover:bg-red-400 border-2 hover:border-red-400 transition duration-300 ease-out" href="/removeArticle/{{$article->id}}">
                                        <img src="{{ url('/images/TrashCan.png') }}" alt="">
                                    </a>
                            @else
                                <button id="addShoppingCart{{$article->id}}" class ="w-14 h-15 rounded-full p-2 border-2 border-green-400 hover:bg-green-400 transition duration-300 ease-out">
                                    <img src="{{ url('/images/warenkorb.png') }}" alt="">
                                </button> 
                            @endif
                        </div>
                    @endif
                </a>
            </div>
        @endforeach
    </div>
</div>
