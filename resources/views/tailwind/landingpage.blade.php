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
        <div class ="bg-cgray mt-20">
            Body
        </div>
    </script>
    <!-- Template für Footer -->
    <script type="text/x-template" id="footer">
        <div class ="mt-20">
            Footer
        </div>
    </script>
-->
</body>
</html>