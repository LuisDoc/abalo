<template>
<div>
    <h1 class="headline text-4xl pb-4 text-purple text-center">Registrieren</h1>
    <div>
        <form id="loginform" @submit.prevent="handleRegister">
             <div v-for="error in errorMessages" :key="error" class="flex justify-center mb-2 text-red-600">
                <!--Errors-->
                <div>{{error[0]}}</div>
            </div>
            <div class="flex justify-center">
                <input type="text" class="mb-2 py-2 px-5 inp" v-model="user.name" placeholder="Name" id="name" name="name" required>
            </div>
            <div class="flex justify-center">
                <input type="email" class="mb-2 py-2 px-5 inp" v-model="user.email" placeholder="E-Mail" id="email" name="email" required>
            </div>
            <div class="flex justify-center mb-2">
                <input type="password" class="mb-2 py-2 px-5 inp" v-model="user.password" placeholder="Passwort" id="password" name="password" required>
            </div>
            <div class="flex justify-center mb-2">
                <input type="password" class="mb-2 py-2 px-5 inp" v-model="user.password_confirmation" placeholder="Passwort Bestätigen" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="flex justify-center mb-4">
                <button class="btn px-4 py-2">Registrieren</button>
            </div>
            <router-link :to="{name:'Login'}" class="block underline text-purple" >Sie haben bereits ein Konto? Melden Sie sich hier an</router-link>
        </form>
    </div> 
</div>
</template>

<script setup>
import store from "../../store"
import {useRouter} from "vue-router"
import {ref} from "vue"
const router = useRouter();
let errorMessages= ref("")
const user = {
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
};
function handleRegister(){
    store.dispatch('register' ,user)
    .then(()=>{router.push({name: "Home"})})
    .catch((err)=>{
        console.log(err)
        errorMessages.value= err.response.data.errors;
        console.log(errorMessages.value)
    })
}
</script>

<style>

</style>