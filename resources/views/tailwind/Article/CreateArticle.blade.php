@extends('tailwind.layouts.app')
@section('content')
<div class ="m-20">
    <h1 class="firstHeadline">Artikel hinzufügen</h1>
    <form class ="flex flex-col justify-center mx-20" action="">    
        <Label class="secondHeadline"> Artikel Informationen</Label>
        <div class ="my-2">
            <input class="outline outline-gray-300 inp p-6 mx-5" type="text" placeholder ="Artikel Name*" required maxlength="100">
            <input class="outline outline-gray-300 inp p-6 mx-5" type="text" placeholder ="Artikel Preis*"required>
        </div>
        <div class ="my-2">
            <textarea class="outline outline-gray-300 inp mx-5 p-6" type="text" rows="10" cols="100" placeholder ="Artikel Beschreibung" maxlength="6000"></textarea>
        </div>
        <div class ="my-2">
            <Label class="thirdheadline text-black mx-5"> Kategorie auswählen: </Label>
            <select class ="outline outline-gray-300 focus:outline-purple rounded-xl p-4" name="" id="">
                @foreach($categories as $category)
                    <option class="" value="">{{$category->ab_name}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
    
@endsection
@section('scripts')
@endsection