@extends('tailwind.layouts.app')
@section('content')
<h1 class="firstHeadline m-20">Artikel hinzufügen</h1>
    <div id="addArticleForm" class="m-20">
        <!-- Inhalt via JS-->
    </div>    
@endsection
@section('scripts')
<!-- Meilenstein 2 Aufgabe 8 -->
<script> 
    "use strict";
    var categories = <?php echo json_encode($categories); ?>;
</script>
<script src="{{ asset('js/newArticlesForm.js') }}"></script>

@endsection