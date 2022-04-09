@extends('tailwind.layouts.app')
@section('content')
<h1 class="firstHeadline m-20">Artikel verkaufen</h1>
    <!-- Fehlermeldungen -->
    @if($errors->any())
        <div class ="m-20">
            @foreach ($errors->all() as $error)
                <div class="text-red-600">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <div id="addArticleForm" class="m-20">
        <!-- Inhalt via JS-->
    </div> 

    <!-- Tailwind Klassen Rendern -->
    <div class="flex flex-col justify-center mx-20" hidden></div>
    <div class="inp outline outline-gray-300 p-6 mx-5" hidden></div>
    <div class="outline outline-gray-300 inp p-6 mx-5" hidden></div>
    <div class="btn p-2 mx-5 rounded-xl border border-purple mb-2" hidden></div>
@endsection
@section('scripts')
<!-- Meilenstein 2 Aufgabe 8 -->
<script>var categories = <?php echo json_encode($categories); ?>;</script>
<script src="{{ asset('js/newArticlesForm.js') }}"></script>
@endsection