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
@endsection
@section('scripts')
<!-- Meilenstein 2 Aufgabe 8 -->
<script> 
    //Umwandlung der PHP-Variable nach Javascript
    "use strict";
    var categories = <?php echo json_encode($categories); ?>;
</script>
<script src="{{ asset('js/newArticlesForm.js') }}"></script>
@endsection