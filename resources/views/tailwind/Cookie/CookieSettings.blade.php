@extends('tailwind.layouts.app')
@section('content')
<div class ="mx-20 my-32">
    <h1 class="firstHeadline">Cookie Einstellungen</h1>
    <div class="mx-64 rounded-xl mt-32">
        <div class ="flex justify-center  mb-64">
            <button id="btnAcceptCookies" class ="btn mx-10 p-5 border-2 border-purple">Cookies aktiviert</button>
            <button id="btnRefuseCookies" class ="btn mx-10 p-5 border-2 border-purple">Cookies deaktiviert</button>
        </div>
        <div class="flex justify-center">
            <a class ="underline rounded-xl p-5 hover:border-2 hover:border-purple hover:text-purple transition ease-in-out duration-300" href="/CookieGuidelines">Mehr Informationen</a>
        </div>
    </div>
</div>

    
@endsection
@section('scripts')
<script src="{{ asset('js/cookiesettings.js') }}"></script>
@endsection