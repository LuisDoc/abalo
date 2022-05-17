<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Vue version 3 -->
    <script src="https://unpkg.com/vue@3"></script>
    <link rel="stylesheet" href="{{ asset('tcss/app.css') }}">
    
    <title>ABALO</title>
</head>
<body>
    <div id="app">
        <!-- Vue Components -->
    </div>
    <script type="module" src="js/Vue/index.js"></script>
    <!-- Template für Header -->
    <script type="text/x-template" id="navbar">
        <!-- Navbar-->
        <div id="nav" class="grid grid-cols-9">
            <div class="col-span-1">
                <div class="pt-6 flex justify-end">
                    <span id=open  @click="toggleNavbar"
                        class="mr-9 font-bold text-xl rounded-full px-2 bg-purple text-white cursor-pointer">&#9776;
                        ABALO
                    </span>
                </div>
            </div>
        </div>
        <!-- Menu-->
        <!--Javascript Navbar-->
        <div id="menu" ref="menu"  class="fixed top-0 left-0 h-full p-10 w-1/6 bg-purple z-50 text-white hidden">
            <div class="relative">
                <div class="absolute -right-5 -top-5" @click="toggleNavbar">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" 
                        class="h-6 w-6 rounded-full hover:bg-white hover:text-purple cursor-pointer" 
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-2" ref="menu_item_list" id="mnav">
            </div>
        </div>
    </script>
    <!-- Template für Body -->
    <script v-if="currentContent === landingPage" type="text/x-template" id="body">
        <div class ="h-screen bg-cgray mt-10">
            <div class ="align-middle grid grid-cols-2 gap-4 mx-32">
                <div class ="w-9/12 h-9/12 flex justify-center p-5"> 
                    <a class =" " href="/index">
                        <img class =" rounded-xl hover:border-4 hover:border-purple transition ease-in-out" 
                        src="{{asset('images/landingPage.jpg')}}" alt="{{asset('images/notfound.jpg')}}">
                    </a>
                </div>
                <div class ="mx-20 p-5">
                    <!-- Suchformular -->
                    <form class="" @submit.prevent="paginationSearch">
                        <div class="relative border-b-2 border-gray-600 hover:border-gray-800">
                            <!-- Daten an Vue übermitteln -->
                            <input type="text" @keyup="paginationSearch" @keydown="paginationSearch" v-model="key" name="search" placeholder="z.B Delorean" class="w-full pl-8 p-2 text-purple">
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
                    <!-- Suchergebnisse -->
                    <div class="">
                        <template v-if="articles.length!=0">
                            <div v-for="article in articles" :key="article.id" class="mt-2 mb-5">
                                <a :href="'/articles#' + article.id">
                                    <div class="p-3 bg-purple rounded-lg hover:outline-double hover:outline-purple">
                                        <h1 class="headline font-bold mb-1 truncate text-sm text-white">@{{ article.ab_name }}</h1>
                                        <p class="text-xs mt-4 text-gray-200 font-semibold mb-0.5"><b class="text-white">Preis:</b> @{{ article.ab_price }}€</p>
                                        <p class="text-xs text-gray-200 mb-0.5 truncate"><b class="text-white">About:</b>
                                            @{{ article.ab_description }}</p>
                                    </div>
                                </a>
                            </div>
                            <span v-for="(link,index) in links.slice(0,-1)" :key="link.label" class="mt-10">
                                <span v-if="index>0 && link.url!=null && link.label!='Next &raquo;'" @click="nextPage(link.label)" :id="link.label" class="bg-purple p-2 rounded-md  mr-1 text-white hover:bg-white hover:text-purple hover:cursor-pointer" v-text="index"></span>
                            </span>
                        </template>
                        <template v-if="articles.length==0 && key.length >= 3" class ="text-red-600 text-semibold text-4xl">
                            Keine Artikel gefunden
                        </template>
                    </div>
                </div>
            </div>
        </div>
        </script>
    <!-- Alternativer Body: Impressum -->
    <script v-if="currentContent === impressum" type="text/x-template" id="body">
        <p> Hello World </p>
    </script>
    <!-- Template für Footer -->
    <script type="text/x-template" id="footer">
        <!--Footer-->
        <div class="bg-black text-white">
            <div class="pl-24 pr-24 pb-24 pt-20">
                <div class="flex justify-end mb-16">
                    <a href="#nav">Zurück nach oben</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
                <div class="grid grid-cols-5">
                    <div>
                        <div class="headline text-xl mb-12">Artikel</div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Ursprung der Artikel</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Neuwaren</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Preisvergleich</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Erklärvideos</a></div>
                    </div>
                    <div>
                        <div class="headline text-xl mb-12">Beratung & Kauf</div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Finanzierung</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Aktionen & Angebote</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Rückgaberichtlinien</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Abalo exclusive</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Händlersuche</a></div>
                    </div>
                    <div>
                        <div class="headline text-xl mb-12">Service und Zubehör</div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Abalo Original Zubehör</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Garantieleistungen</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="/faq">Häufige Fragen
                                (FAQ)</a></div>
                    </div>
                    <div>
                        <div class="headline text-xl mb-12">Abalo Welt</div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Abalo</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Unternehmen</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Karriere bei Abalo</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Karriere im
                                Einzelhandel</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Abalo Shopping World</a>
                        </div>
                    </div>
                    <div>
                        <div class="headline text-xl mb-12">Zubehör</div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Kontakt / Newsletter</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Händlersuche</a></div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Abalo Online Beratung</a>
                        </div>
                        <div class="mb-4 headline text-xs"><a class="hover:text-gray-400" href="">Hinweisgebersystem</a>
                        </div>
                    </div>
                </div>
                <div class="flex text-white justify-end mt-6">
                    <a href="" class="mr-2">
                        <img src="{{ asset('images/facebook.png') }}" class="w-6 h-6" alt="">
                    </a>
                    <a href="" class="mr-2">
                        <img src="{{ asset('images/twitter.png') }}" class="w-6 h-6" alt="">
                    </a>
                    <a href="" class="mr-2">
                        <img src="{{ asset('images/instagram.png') }}" class="w-6 h-6" alt="">
                    </a>
                    <a href="" class="mr-2">
                        <img src="{{ asset('images/yt.png') }}" class="w-6 h-6" alt="">
                    </a>
                </div>
                <div class="flex mt-5">
                    <div class="text-xs mr-24">&#64;2022 LUIS&ampNILUSCHE AG GmbH Inc. Co. KG</div>
                    <a class="text-xs mr-4" @click ="handleContentSwitch" href=""></a>
                    <a class="text-xs mr-4" href="">Rechtliches</a>
                    <a class="text-xs mr-4" href="">Datenschutz</a>
                    <a id ="refCookieSettings" class="text-xs mr-4" href="/CookieSettings">Cookie Einstellungen</a>
                    <a class="text-xs mr-4" href="/CookieGuidelines">Cookie Richtlinie</a>
                    <a class="text-xs mr-4" href="">Presse</a>
                    <a class="text-xs mr-4" href="">Karriere</a>
                </div>
            </div>
        </div>
    </script>
</body>
</html>