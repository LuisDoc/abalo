@extends('tailwind.layouts.app')
@section('content')
    <!-- Container -->
    <div class ="m-20">
        <h1 class ="firstHeadline">Warenkorb</h1>
        <!-- Anzeige aller Artikel innerhalb einer Tabelle -->
        <table id="anker" class ="w-full outline outline-purple rounded-xl">
            <thead class ="bg-gray-200 border-b-2 border-purple">
                <td class ="secondHeadline p-5">Abbildung</td>
                <td class ="secondHeadline p-5">Name</td>
                <td class ="secondHeadline p-5">Preis</td>
                <td class ="secondHeadline p-5"></td>
            </thead>
            <tbody id="carttable">
            </tbody>
        </table>
        <div class ="flex justify-end my-20 mr-10">
            <!-- First Row -->
            <div>
                <button class ="btn p-2 text-2xl hover:border hover:border-purple">Bestellen</button>
            </div>
            
        </div>
    </div>
    
@endsection
@section('scripts')
    <!-- Convert PHP Variable to JavaScript -->
    <script src="{{ asset('/js/ShoppingCart/viewShoppingCart.js') }}"></script>
@endsection