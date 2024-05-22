@extends('layouts.app')
 
 @section('content')
 <div class="row">
     <div class="col-2">
         @component('components.sidebar', ['categories' => $categories, 'major_categories' => $major_categories])
         @endcomponent
     </div>
     <div class="col-9">
         <h1>おすすめ商品</h1>
         <div class="row">
             <div class="col-4">
                 <a href="#">
                     <img src="{{ asset('img/chestnut.jpg') }}" class="img-thumbnail">
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             和栗の詰め合わせ<br>
                             <label>￥2000</label>
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-4">
                 <a href="#">
                     <img src="{{ asset('img/persimmon.jpg') }}" class="img-thumbnail">
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             おいしい柿<br>
                             <label>￥500</label>
                         </p>
                     </div>
                 </div>
             </div>
 
             <div class="col-4">
                 <a href="#">
                     <img src="{{ asset('img/orange.jpg') }}" class="img-thumbnail">
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             旬なみかん<br>
                             <label>￥1200</label>
                         </p>
                     </div>
                 </div>
             </div>
 
         </div>
 
         <h1>新着商品</h1>
         <div class="row">
             <div class="col-3">
                 <a href="#">
                     <img src="{{ asset('img/robot-vacuum-cleaner.jpg') }}" class="img-thumbnail">
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             ロボット掃除機<br>
                             <label>￥55000</label>
                         </p>
                     </div>
                 </div>
             </div>
 
             <div class="col-3">
                 <a href="#">
                     <img src="{{ asset('img/sofa.jpg') }}" class="img-thumbnail">
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             3人掛けソファー<br>
                             <label>￥35000</label>
                         </p>
                     </div>
                 </div>
             </div>
 
             <div class="col-3">
                 <a href="#">
                     <img src="{{ asset('img/cup.jpg') }}" class="img-thumbnail">
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             コーヒーカップ<br>
                             <label>￥1000</label>
                         </p>
                     </div>
                 </div>
             </div>
 
             <div class="col-3">
                 <a href="#">
                     <img src="{{ asset('img/cutlery.jpg') }}" class="img-thumbnail">
                 </a>
                 <div class="row">
                     <div class="col-12">
                         <p class="samuraimart-product-label mt-2">
                             食器 カトラリーセット1組<br>
                             <label>￥2000</label>
                         </p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection
