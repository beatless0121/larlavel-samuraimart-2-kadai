@extends('layouts.app')
 
 @section('content')
 <div class="container d-flex justify-content-center mt-3">
     <div class="w-75">
         <h1>ショッピングカート</h1>
 
         <div class="row">
             <div class="offset-8 col-4">
                 <div class="row">
                     <div class="col-6">
                         <h2>数量</h2>
                     </div>
                     <div class="col-6">
                         <h2>合計</h2>
                     </div>
                 </div>
             </div>
         </div>
 
         <hr>
 
         <div class="row">
             @foreach ($cart as $product)
             <div class="col-md-2 mt-2">
                 <a href="{{route('products.show', $product->id)}}">
                     @if ($product->options->image)
                     <img src="{{ asset($product->options->image) }}" class="img-fluid w-100">
                     @else
                     <img src="{{ asset('img/dummy.png')}}" class="img-fluid w-100">
                     @endif
                 </a>
             </div>
             <div class="col-md-6 mt-4">
                 <h3 class="mt-4">{{$product->name}}</h3>
             </div>
             <div class="col-md-2">
                 <h3 class="w-100 mt-4">{{$product->qty}}</h3>
             </div>
             <div class="col-md-2">
                 <h3 class="w-100 mt-4">￥{{$product->qty * $product->price}}</h3>
             </div>
             @endforeach
         </div>

         <hr>
 
           <div class="offset-8 col-4">
             <div class="row">
              <div class="col-6">
                 <h2>送料</h2>
            </div>
             <div class="col-6">
             <h2>￥{{ $carriage_cost }}</h2>
           </div>
         </div>
         </div>
 
         <hr>
 
         <div class="offset-8 col-4">
             <div class="row">
                 <div class="col-6">
                     <h2>合計</h2>
                 </div>
                 <div class="col-6">
                     <h2>￥{{$total}}</h2>
                 </div>
                 <div class="col-12 d-flex justify-content-end">
                     表示価格は税込みです
                 </div>
             </div>
         </div>

         <form method="post" action="{{route('carts.destroy')}}" class="d-flex justify-content-end mt-3">
             @csrf
             <input type="hidden" name="_method" value="DELETE">
             <a href="{{route('top')}}" class="btn samuraimart-favorite-button border-dark text-dark mr-3">
                 買い物を続ける
             </a>
             @if ($total > 0)
             <div class="btn samuraimart-submit-button" data-bs-toggle="modal" data-bs-target="#buy-confirm-modal">購入を確定する</div>
             @else
             <div class="btn samuraimart-submit-button disabled" data-bs-toggle="modal" data-bs-target="#buy-confirm-modal">購入を確定する</div>
             @endif

             <div class="modal fade" id="buy-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="staticBackdropLabel">購入を確定しますか？</h5>
                             <button type="button" class="close" data-bs-dismiss="modal" aria-label="閉じる">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn samuraimart-favorite-button border-dark text-dark" data-bs-dismiss="modal">閉じる</button>
                             <button type="submit" class="btn samuraimart-submit-button">購入</button>
                         </div>
                     </div>
                 </div>
             </div>
         </form>
     </div>
 </div>
 @endsection
