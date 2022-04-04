@extends('tailwind.layouts.app')
@section('content')
    <div class="bg-cgray py-28 px-40 flex justify-center">
          <div class="p-8 px-40 bg-white">
            <h1 class="headline text-4xl pb-4 text-purple text-center">Anmelden</h1>
            <div>
                <form action="/login" method="POST" id="loginform">
                    @csrf
                    <div class="flex justify-center mb-2">
                         @foreach ($errors->all() as $error)
                                <li class="text-red-600 list-none ">{{ $error }}</li>
                         @endforeach
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

        form.password.addEventListener('keyup',(e)=>{
           if(form.password.value == ""){
                form.password.classList.add("errorinput");
                form.password.classList.remove("successinput");
           }else{
                form.password.classList.remove("errorinput");
                form.password.classList.add("successinput");
           }
        })
    </script>
@endsection