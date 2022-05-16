@extends('tailwind.layouts.app')

@section('scripts')
<script>
    const search = document.querySelector("#search");
    const searchbar = document.querySelector("#searchbar");
    const back = document.querySelector("#back")
    search.addEventListener('click', function() {
        searchbar.classList.add('block');
        searchbar.classList.remove('hidden');
    })
    back.addEventListener('click', (e) => {
        searchbar.classList.remove('block');
        searchbar.classList.add('hidden');
    })
</script>
@endsection
<!-- Div vue-nav -->
@section("searchicon")
<div class="flex justify-end">
    <span id="search" class="m-6 hover:cursor-pointer grayscale hover:grayscale-0 transition ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </span>
</div>
@endsection

@section("searchbar")
<!--Searchbar-->
<div id="searchbar" class="z-10 absolute top-0 w-full bg-white hidden">
    <div class="grid grid-cols-3">
        <div class="m-5"><span class=" hover:cursor-pointer" id="back">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-2 ml-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="rmund" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </span>
        </div>
        <div class="m-5">
            <form action="" method="" @submit.prevent="">
                <div class="relative border-b-2 border-gray-600 hover:border-gray-800">
                    <!-- Daten an View übermitteln -->
                    <input type="text" @keyup="handleChange" @keydown="handleChange" v-model="key" name="search" placeholder="z.B Delorean" class="w-full pl-8 p-2 text-purple">
                    <span class="absolute left-0 mr-6 mt-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <button class="absolute right-0 mr-6 mb-2  p-1  mt-1 hover:bg-gray-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="m-5"></div>
    </div>
</div>
@endsection
<!-- Ende DIV vue-nav -->


@section('content')   

       
        <div class="bg-cgray">    
            <div class="mt-20">
                <div v-if = "showHeadline" class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
                    Ihre Suchergebnisse
                </div>
                <div class="grid lg:grid-cols-1 md:grid-cols-1 grid-cols-1 p-32 px-64 pt-1 gap-4">
                    <template v-if="articles.length!=0">
                        <div v-for="article in articles" :key="article.id" class="">
                            <a :href="'#' + article.id" class=" flex justify-center block text-base text-white rounded-full border border-purple my-2 mx-12 px-5 py-3 bg-purple hover:bg-white hover:text-purple transition ease-in-out">
                                @{{article.ab_name}}
                            </a>

                        </div>
                    </template>
                    <template v-if="articles.length==0 && showHeadline" class ="text-red-600 text-semibold text-4xl">
                        Keine Artikel gefunden
                    </template>
                </div>
            </div>
            <!-- Gesuchte Artikel -->
            <!-- -------------------------------------------------------------------------- -->
            <!-- Alle Artikel -->
            <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
                {{$headline}}
            </div>
            <!-- Anzeige aller Inserate -->
            @include('tailwind.layouts.viewArticles')
        </div>
    
@endsection

