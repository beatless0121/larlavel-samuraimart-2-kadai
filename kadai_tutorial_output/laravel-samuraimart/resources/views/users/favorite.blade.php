@extends('layouts.app')
 
 @section('content')
 <div class="container  d-flex justify-content-center mt-3">
     <div class="w-75">
         <h1>お気に入り</h1>
 
         <hr>
 
         <div class="row">
             @foreach ($favorites as $fav)
             <div class="col-md-7 mt-2">
                 <div class="d-inline-flex">
                     <a href="{{route('products.show', $fav->favoriteable_id)}}" class="w-25">
                         @if (App\Models\Product::find($fav->favoriteable_id)->image !== "")
                         <img src="{{ asset(App\Models\Product::find($fav->favoriteable_id)->image) }}" class="img-fluid w-100">
                         @else
                         <img src="{{ asset('img/dummy.png') }}" class="img-fluid w-100">
                         @endif
                     </a>
                     <div class="container mt-3">
                         <h5 class="w-100 samuraimart-favorite-item-text">{{App\Models\Product::find($fav->favoriteable_id)->name}}</h5>
                         <h6 class="w-100 samuraimart-favorite-item-text">&yen;{{App\Models\Product::find($fav->favoriteable_id)->price}}</h6>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 d-flex align-items-center justify-content-end">
                 <a href="{{ route('products.favorite', $fav->favoriteable_id) }}" class="samuraimart-favorite-item-delete">
                     削除
                 </a>
             </div>
             <div class="col-md-3 d-flex align-items-center justify-content-end">
               <form method="POST" action="{{route('carts.store')}}" class="m-3 align-items-end">
                     @csrf
                     <input type="hidden" name="id" value="{{App\Models\Product::find($fav->favoriteable_id)->id}}">
                     <input type="hidden" name="name" value="{{App\Models\Product::find($fav->favoriteable_id)->name}}">
                     <input type="hidden" name="price" value="{{App\Models\Product::find($fav->favoriteable_id)->price}}">
                     <input type="hidden" name="image" value="{{App\Models\Product::find($fav->favoriteable_id)->image}}">
                     <input type="hidden" name="qty" value="1">
                     <input type="hidden" name="weight" value="0">
                     <button type="submit" class="btn samuraimart-favorite-add-cart">カートに入れる</button>
                 </form>
             </div>
             @endforeach
         </div>
 
         <hr>
     </div>
 </div>
 @endsection