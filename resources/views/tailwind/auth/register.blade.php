@extends('tailwind.layouts.app')
@section('content')
    <div class="bg-cgray py-28 px-40 flex justify-center">
          <div class="p-8 px-40 bg-white">
        @if(Auth::guest())
            <h1 class="headline text-4xl pb-4 text-purple text-center">Registrieren</h1>
            <div>
                <form action="/register" method="POST" id="loginform">
                    @csrf
                    <div class="flex justify-center mb-2">
                         @foreach ($errors->all() as $error)
                                <li class="text-red-600 list-none ">{{ $error }}</li>
                         @endforeach
                    </div>
                    <div class="flex justify-center">
                        <input type="text" class="mb-2 py-2 px-5 inp" placeholder="Name" id="name" name="name" required>
                    </div>
                    <div class="flex justify-center">
                        <input type="email" class="mb-2 py-2 px-5 inp" placeholder="E-Mail" id="email" name="email" required>
                    </div>
                    <div class="flex justify-center mb-2">
                        <input type="password" class="mb-2 py-2 px-5 inp" placeholder="Passwort" id="password" name="password" required>
                    </div>
                    <div class="flex justify-center mb-2">
                        <input type="password" class="mb-2 py-2 px-5 inp" placeholder="Passwort Bestätigen" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="flex justify-center mb-4">
                        <button class="btn px-4 py-2">Registrieren</button>
                    </div>
                    <a href="/showLogin" class="block underline text-purple" >Sie haben bereits ein Konto? Melden Sie sich hier an</a>
                </form>
            </div>
        @else
            <h1 class="headline text-4xl pb-4 text-purple text-center">Sie sind bereits angemeldet</h1>
        @endif
          </div>  
    </div>
@endsection
@section('scripts')
    <script>
        const form = document.getElementById("loginform");
        const emailregex =/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        form.email.addEventListener('keyup',(e)=>{
            form.email.classList.remove("inp")
            if(!emailregex.test(form.email.value)){      
                form.email.classList.add("errorinput");
                form.email.classList.remove("successinput");
            }else{
                form.email.classList.remove("errorinput");
                form.email.classList.add("successinput");
            }
        })

        form.name.addEventListener('keyup',(e)=>{
           if(form.name.value == ""){
                form.name.classList.add("errorinput");
                form.name.classList.remove("successinput");
           }else{
                form.name.classList.remove("errorinput");
                form.name.classList.add("successinput");
           }
        })

        form.password.addEventListener('keyup',(e)=>{
           if(form.password.value == ""){
                form.password.classList.add("errorinput");
                form.password.classList.remove("successinput");
           }else{
                form.password.classList.remove("errorinput");
                form.password.classList.add("successinput");
           }
        })

        form.password_confirmation.addEventListener('keyup',(e)=>{
            if(form.password.value!=form.password_confirmation.value){
                form.password_confirmation.classList.add("errorinput");
                form.password_confirmation.classList.remove("successinput");
            }else{
                form.password_confirmation.classList.remove("errorinput");
                form.password_confirmation.classList.add("successinput");
            }
        })
    </script>
@endsection