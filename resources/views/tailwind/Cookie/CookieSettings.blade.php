@extends('tailwind.layouts.app')
@section('content')
<div class ="mx-20 my-32">
    <h1 class="firstHeadline">Cookie Einstellungen</h1>
    <div class="mx-64 rounded-xl">
        <div class ="flex justify-center">
            <button id="btnAcceptCookies" class ="">Cookies aktiviert</button>
            <button id="btnRefuseCookies" class ="">Cookies deaktiviert</button>
        </div>
        <div class="flex justify-center">
            <a class ="underline" href="/CookieGuidelines">Mehr Informationen</a>
        </div>
    </div>
</div>

    
@endsection
@section('scripts')
<script src="{{ asset('js/cookiesettings.js') }}"></script>
@endsection