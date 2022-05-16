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
            <div class="col-start-3 col-span-4">
                <!-- Suchleiste implementieren -->

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
    <script type="text/x-template" id="body">
        <div class ="h-screen bg-cgray mt-10">
            <div class ="align-middle grid grid-cols-2 gap-4 mx-32">
                <div class ="flex justify-center p-5"> 
                    <a class ="w-9/12 h-9/12 " href="/index">
                        <img class =" rounded-xl hover:border-4 hover:border-purple transition ease-in-out" 
                        src="{{asset('images/landingPage.jpg')}}" alt="{{asset('images/notfound.jpg')}}">
                    </a>
                </div>
                <div class ="p-5">
                    <p class ="w-9/12 h-9/12 flex justify-center">Hier suche implementieren</p>
                </div>
            </div>
        </div>
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
                    <a class="text-xs mr-4" href="/impressum">Impressum</a>
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