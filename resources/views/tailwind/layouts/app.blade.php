<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<!--npx tailwindcss -i src/styles.css -o public/styles.css --watch-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abalo</title>
    <style>
        * {
            font-family: 'Open Sans', sans-serif;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('tcss/app.css') }}">
    <script src="https://unpkg.com/vue@3"></script>
</head>

<body>
    <div id="app">
    @yield("searchbar")
    
    <!-- Navbar-->
    <div id="nav" class="grid grid-cols-9">
        <div class="col-span-1">
            <div class="pt-6 flex justify-end">
                <span id=open
                    class="mr-9 font-bold text-xl rounded-full px-2 bg-purple text-white cursor-pointer">&#9776;
                    ABALO</span>
            </div>
        </div>
    <div class="col-start-3 col-span-4">
        @yield("searchicon")
    </div>
        
        <!-- Warenkorb Button -->
        @if(!Auth::guest())
            <div class="col-span-1 mx-auto">
                <a href="/ShoppingCart" class="flex my-4 pl-6 pr-4 transition ease-in-out duration-300 rounded-full border-purple hover:border-2">
                    <img class ="w-9 h-9" src="{{asset('images/warenkorb.png')}}" alt="">
                    <span id="shoppingcartbell" class ="text-black h-7 ml-2 relative top-0 right-2"></span>
                </a>
            </div>
        @endif
        <div class="col-span-2">
            <div class="flex justify-end">
                <span id="profileicon" class="mt-6 mr-1 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                @if (Auth::guest())
                    <span id="login"
                        class="mt-6 mb-6 mr-10 text-purple hover:text-black hover:cursor-pointer text-xl">Abalo
                        Login</span>
                @else
                    <span id="login"
                        class="mt-6 mb-6 mr-10 text-purple hover:text-black hover:cursor-pointer text-xl">My
                        Profile</span>
                @endif
            </div>
        </div>
    </div>
    <!--Javascript Navbar-->
    <div id=menu class="
            fixed top-0 left-0 h-full p-10 w-1/6 bg-purple z-50 text-white hidden">
        <div class="relative">
            <div class="absolute -right-5 -top-5">
                <svg id="close" xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 rounded-full hover:bg-white hover:text-purple cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <div class="mt-2" id="mnav"></div>
    </div>
    @yield('content')
    <!-- Login-->
    <div class="login">
        <div class="absolute  right-0 bg-white -mt-1">
            <div class="p-12">
                @if (Auth::guest())
                    <div class="headline text-5xl">Willkommen bei Abalo</div>
                    <div class="mt-5 text-md text-gray-600">Der individuelle Zugang zur digitalen Welt von Abalo:</div>
                    <div class="mt-5 text-md text-gray-600">Schnelle Kontaktaufnahme mit persönlichem Abalo Partner
                    </div>
                    <div class="mt-5 text-gray-400 text-xs"> Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Possimus tenetur id deleniti architecto</div>
                    <div class="text-gray-400 text-xs">Lorem ipsum dolor sit amet.</div>

                    <div class="mt-12">
                        <a href="/showLogin" class="py-4 px-10 text-md headline btn border-purple border">
                            Anmelden
                        </a>
                        <a class="ml-1 py-4 px-6 text-md bg-white headline hover:bg-gray-200 transition ease-in-out border border-black"
                            href="">
                            Mehr erfahren
                        </a>
                    </div>
                @else
                    <div>
                        <div class="mt-5 text-md text-gray-600">Wilkommen zurück</div>
                        <a href="/myarticle" class="my-2 block py-4 px-10 text-md headline btn border-purple border">Meine Artikel</a>
                        <a href="/newarticle" class="my-2 block py-4 px-10 text-md headline btn border-purple border">Artikel hinzufügen</a>
                        <a href="/logout" class="block py-4 px-10 text-md headline btn border-purple border">
                            Abmelden
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
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
    <!-- Cookie Dialog -->
    <div id="CookieDialog" class="flex fixed bottom-0 w-screen bg-purple text-white z-50 h-32 hidden">
        <div class ="w-2/3 mt-4 mb-4 mx-10" >
            <h1 class="text-align-left text-4xl">Cookie-Einstellungen</h1>
            <p class ="text-base">
                Mit einem Klick auf "Zustimmen" akzeptieren Sie die Nutzung von Cookies,
                um Ihnen moderne Funktionalitäten und Services bieten zu können.
                <a class ="text-lg italic underline"href="/CookieGuidelines">Mehr Informationen</a>
            </p>
        </div>
        <div class ="w-1/3 mt-4 mb-4 mx-10 flex justify-center">
            <button id="CookieDialogYes" class="CookieButton">Akzeptieren</button>
            <button id="CookieDialogNo" class="CookieButton">Ablehnen</button>
        </div>
        
    </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    @if(!Auth::guest())
        <script>
            var auth_user_id = <?php echo Auth()->User()->id; ?>;
        </script>
    @else
        <script>
            var auth_user_id = 0;
        </script>
    @endif
    @if(isset($articles))
        <script>
            var articles = <?php echo json_encode($articles); ?>;
        </script>
    @else
        <script>var articles = null;</script>
    @endif
    <script>
        "use strict";
        //Umwandeln von PHP Variablen nach JavaScript
        
        //Definition of global variables
        let shoppingcartkey ="ShoppingCart";
        let cookiekey ="acceptCookies";
    </script>
    
    <!-- Artikel suche -->
    <script src="{{asset('js/ArticleSearch/articlesearch.js')}}"></script>
    <!-- Cookie Scripts -->
    <script src="{{ asset('js/coockiecheck.js') }}"></script>
    <!-- Navigation Scripts -->
    <script src="{{ asset('js/m2-nav.js') }}"></script>
    <!-- Shopping Cart Scripts -->
        @if(!Auth::guest())
            <script src="{{ asset('js/ShoppingCart/ShoppingCartCounter.js') }}"></script>
            <script src="{{ asset('js/ShoppingCart/addToShoppingCart.js') }}"></script>
        @endif
    <!-- Navbar -->
    <script>
        const search = document.querySelector("#search");
        const searchbar = document.querySelector("#searchbar");
        const back = document.querySelector("#back")

        const login = document.querySelector('.login');
        const loginbutton = document.querySelector('#login');
        search.addEventListener('click', function() {
            searchbar.classList.add('block');
            searchbar.classList.remove('hidden');
        })
        back.addEventListener('click', (e) => {

            searchbar.classList.remove('block');
            searchbar.classList.add('hidden');
        })

        loginbutton.addEventListener('click', (e) => {
            const body = document.body;
            console.log(login.style.display);
            if (login.style.display == "none" || !login.style.display) {
                login.style.display = "block";
                body.style.overflow = 'hidden';
                const icon = document.querySelector("#profileicon");
                icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>`;
                console.log("a");
            } else {
                login.style.display = "none";
                body.style.overflow = 'auto';
                const icon = document.querySelector("#profileicon");
                icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>`;
                console.log("b")
            }

        })
        login.addEventListener('click', (e) => {
            const body = document.body;
            login.style.display = "none";
            body.style.overflow = 'auto';
            const icon = document.querySelector("#profileicon");
            icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>`
        })
    </script>
    @yield('scripts')
    <!-- Rendern von Typescript klassen -->
    <div class ="hidden">
        <div class ="w-14 h-15 rounded-full p-2 border-2 border-red-400 hover:bg-red-400 transition duration-300 ease-out"></div>
    </div>
</body>

</html>
