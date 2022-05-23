<template>
<div>
    <h1 class="headline text-4xl pb-4 text-purple text-center">Anmelden</h1>
    <div>
        <form @submit.prevent="handleLogin" id="loginform">
            <div v-if="errorMessage" class="flex justify-center mb-2 text-red-600">
                <!--Errors-->
                {{errorMessage.email[0]}}
                {{errorMessage.password[0]}}
            </div>
            <div class="flex justify-center">
                <input type="email" class="mb-2 py-2 px-5 inp" v-model="user.email" placeholder="E-Mail" id="email" name="email" required>
            </div>
            <div class="flex justify-center mb-2">
                <input type="password" class="mb-2 py-2 px-5 inp" v-model="user.password" placeholder="Passwort" id="password" name="password" required>
            </div>
            <div class="flex justify-center mb-4">
                <button class="btn px-4 py-2">Anmelden</button>
            </div>
            <router-link :to="{name:'Register'}" class="block underline text-purple" >Noch kein Konto? Hier registrieren!</router-link>
        </form>
    </div>
</div>
</template>

<script setup>
import store from "../../store"
import {useRouter} from "vue-router"
import {ref} from "vue"
const router = useRouter();
const user = {
    email: '',
    password: ''
}
let errorMessage = ref('');
function handleLogin(){
    store.dispatch('login', user)
    .then(()=>router.push({name:"Home"}))
    .catch((err)=>{
        console.log(err)
        errorMessage.value = err.response.data.errors;
    })

}
</script>

<style>

</style>