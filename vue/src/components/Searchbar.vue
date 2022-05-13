<template>
    <div id="searchbar" class="z-10 absolute top-0 w-full bg-white" :class="{hidden: !search}">
        <div class="grid grid-cols-3">
            <div class="m-5"><span class=" hover:cursor-pointer" id="back" @click="search=false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-2 ml-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="rmund" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </span>
            </div>
            <div class="m-5">
                <form action="/articles" method="GET">
                    <div class="relative border-b-2 border-gray-600 hover:border-gray-800">
                        <input type="text" name="search" placeholder="z.B Delorean" class="w-full pl-8 p-2 text-purple">
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
</template>

<script>
export default {
    name: "Searchbar",
    props:["search"]
}
</script>

<style>

</style>