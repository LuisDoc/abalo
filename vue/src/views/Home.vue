<template>
   <div>
        <!--Main Content-->
        <div class="relative">
            <div style="background-image: url('../../public/images/shop.jpg'); height:857px"></div>
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
            <div class="flex justify-center align-center">
                <a class="mt-6 mb-6 py-4 px-8 pr-2 btn block w-36" href="/articles">
                    Alle Artikel
                </a>
            </div>


        </div>
   </div> 
</template>

<script>

export default {
    name: "Home",
    
}
</script>

<style>

</style>