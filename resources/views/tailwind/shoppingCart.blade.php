@extends('tailwind.layouts.app')
@section('content')
    <!-- Container -->
    <div class ="m-20">
        <h1 class ="firstHeadline">Warenkorb</h1>
        <!-- Anzeige aller Artikel innerhalb einer Tabelle -->
        <div id="anker" class ="flex flex-col">
            
        </div>
        <div class ="flex justify-end">
            <!-- First Row -->
            <div>
                <button class ="btn p-2 hover:border hover:border-purple">Bestellen</button>
            </div>
            
        </div>
    </div>
    
@endsection
@section('scripts')
    <!-- Convert PHP Variable to JavaScript -->
    <script src="{{ asset('/js/ShoppingCart/viewShoppingCart.js') }}"></script>
@endsection