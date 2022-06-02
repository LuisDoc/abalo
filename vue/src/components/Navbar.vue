<template>
<div>
    <Searchbar :search="search"/>
  <div id="nav" class="grid grid-cols-9">
        <div class="col-span-1">
            <div class="pt-6 flex justify-end">
                <span id=open @click="navbar=true"
                    class="mr-9 font-bold text-xl rounded-full px-2 bg-purple text-white cursor-pointer">&#9776;
                    ABALO</span>
            </div>
        </div>
        
        <div class="col-start-3 col-span-4" >
            <div class="flex justify-end"  @click="search=!search">
                <span id="search" class="m-6 hover:cursor-pointer grayscale hover:grayscale-0 transition ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
            </div>
        </div>
        <!-- Warenkorb Button -->
            <div v-if="user.token!=null" class="col-span-1 mx-auto">
                <router-link :to="{name:'Cart'}" class="flex my-4 pl-6 pr-4 transition ease-in-out duration-300 rounded-full border-purple hover:border-2">
                    <img class ="w-9 h-9" src="../../public/images/warenkorb.png" alt="">
                    <span id="shoppingcartbell" class ="text-black h-7 ml-2 relative top-0 right-2"></span>
                </router-link>
            </div>
        <div class="col-span-2">
            <div class="flex justify-end">
                <span id="profileicon" class="mt-6 mr-1 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                    <span @click="showlogin=!showlogin" v-if="user.token==null" id="login" class="mt-6 mb-6 mr-10 text-purple hover:text-black hover:cursor-pointer text-xl">Abalo Login</span>
                    <span @click="showlogin=!showlogin" v-else id="login"
                        class="mt-6 mb-6 mr-10 text-purple hover:text-black hover:cursor-pointer text-xl">My
                        Profile</span>
            </div>
        </div>
    </div>
    <div id=menu class="fixed top-0 left-0 h-full p-10 w-1/6 bg-purple z-50" :class="{hidden: !navbar}">
        <div class="relative">
            <div class="absolute -right-5 -top-5">
                <svg id="close" xmlns="http://www.w3.org/2000/svg" @click="navbar=false"
                    class="h-6 w-6 rounded-full hover:bg-white hover:text-purple cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <!-- Drop Down Menu -->
        <div class="mt-2" id="mnav">
            <ul class="list">
                <li class="list__item--yellow list__item" @click="navbar=!navbar"><router-link :to="{name:'Home'}">Home</router-link></li>
                <li class="list__item--primary--1 list__item" @click="navbar=!navbar"><router-link :to="{name:'Articles'}">Artikel</router-link></li>
                <li class="list__item--red--5 list__item" @click="navbar=!navbar"><router-link :to="{name:'Home'}">Kategorien</router-link></li>
                <li class="list__item--secondary--6 list__item" @click="navbar=!navbar"><router-link :to="{name:'NewArticle'}">Verkaufen</router-link></li>
                <li class="list__item--green--6 list__item" @click="navbar=!navbar">Unternehmen</li>
                <li @click="navbar=!navbar" class="sub-nav list__item list__item--orange--6"><router-link :to="{name:'Home'}">Philosophie</router-link></li>
                <li @click="navbar=!navbar" class="sub-nav list__item list__item--blue--6"><router-link :to="{name:'Home'}">Karriere</router-link></li>
            </ul>
        </div>
    </div>
    <div :class="{hidden:!showlogin}" class= "">
        <div class="relative right-0 ml-4 bg-white -mt-1" >
            <div class="p-12">
                    <div v-if="user.token==null">
                        <div class="headline text-5xl">Willkommen bei Abalo</div>
                        <div class="mt-5 text-md text-gray-600">Der individuelle Zugang zur digitalen Welt von Abalo:</div>
                        <div class="mt-5 text-md text-gray-600">Schnelle Kontaktaufnahme mit persönlichem Abalo Partner
                        </div>
                        <div class="mt-5 text-gray-400 text-xs"> Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Possimus tenetur id deleniti architecto</div>
                        <div class="text-gray-400 text-xs">Lorem ipsum dolor sit amet.</div>

                        <div class="mt-12">
                            <span  @click="showlogin=!showlogin">
                                <router-link  :to="{name:'Login'}" class="py-4 px-10 text-md headline btn border-purple border">
                                    Anmelden
                                </router-link>
                            </span>
                            <a class="ml-1 py-4 px-6 text-md bg-white headline hover:bg-gray-200 transition ease-in-out border border-black"
                                href="">
                                Mehr erfahren
                            </a>
                        </div>
                    </div>
                    <div v-else>
                        <div class="mt-5 text-xl font-bold text-gray-600 text-center">Wilkommen zurück</div>
                        <router-link :to="{name:'MyArticles'}" class="my-2 block py-4 px-10 text-md headline btn border-purple border text-center font-semibold hover:cursor-pointer">Meine Artikel</router-link>
                        <a href="/newarticle" class="my-2 block py-4 px-10 text-md headline btn border-purple border text-center font-semibold">Artikel hinzufügen</a>
                        <span  @click="handleLogout" class="block py-4 px-10 text-md headline btn border-purple border text-center font-semibold hover:cursor-pointer">
                            Abmelden
                        </span>
                    </div>
            </div>
        </div>
    </div>

</div>

</template>

<script>
import {mapState} from 'vuex'
import Searchbar from "../components/Searchbar.vue"
import store from "../store";
export default {
    components:{ Searchbar},
    name:"Navbar",
    computed: {
        ...mapState(['user'])
    },
    data(){
        return{
            showlogin: false,
            navbar: false,
            search: false,
        }
    },
    methods:{
        handleLogout(){
            store.dispatch('logout');
        }
    }
}
</script>

<style lang="scss">
    $black: rgba(0,0,0,0.5);

    @keyframes showBlock {
        from { display: block; opacity: 0; }
        to { opacity: 1; }
    }

    @mixin bg() {
        background: $black;
        position:fixed;
        top:4.9rem;
        left:0;
    }

    .login{
        @include bg();
        width:100%;
        height:100%;
        animation:showBlock 0.3s;
    }

    $colors: (
        primary: #37E2D5,
        secondary: #A760FF,
        red: #F24C4C,
        yellow: #F7D716,
        green: #5FD068,
        orange: #EC9B3B,
        blue: #646FD4
    );
    

    .list{
        .list__item{
            color:white;
            
            &:hover{
                opacity: .8;
            }
        }
        @each $key, $val in $colors{
            .list__item--#{$key}{
                color:$val;
            }
            @for $i from 1 through 9{
                .list__item--#{$key}--#{$i}{
                    color:mix(white, $val, $i*10);
                }
            }
        }
        
    }
</style>