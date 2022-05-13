<template>
   <div class="bg-cgray py-28 px-40 flex justify-center">
          <div class="p-8 px-40 bg-white">
            <h1 class="headline text-4xl pb-4 text-purple text-center">Anmelden</h1>
            <div>
                <form action="/login" method="POST" id="loginform">
                    <div class="flex justify-center mb-2">
                        <!--Errors-->
                    </div>
                    <div class="flex justify-center">
                        <input type="email" class="mb-2 py-2 px-5 inp" placeholder="E-Mail" id="email" name="email" required>
                    </div>
                    <div class="flex justify-center mb-2">
                        <input type="password" class="mb-2 py-2 px-5 inp" placeholder="Passwort" id="password" name="passwort" required>
                    </div>
                    <div class="flex justify-center mb-4">
                        <button class="btn px-4 py-2">Anmelden</button>
                    </div>
                    <a href="/showRegister" class="block underline text-purple" >Noch kein Konto? Hier registrieren!</a>
                </form>
            </div>
          </div>  
    </div> 
</template>

<script>
export default {
    name:"Login"
}
</script>

<style>

</style>