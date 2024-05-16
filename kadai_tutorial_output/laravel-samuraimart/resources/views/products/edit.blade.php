@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <h1>商品情報更新</h1>
 
     <form action="{{ route('products.update',$product->id) }}" method="POST">
         @csrf
         @method('PUT')
         <div class="form-group">
             <label for="product-name">商品名</label>
             <input type="text" name="name" id="product-name" class="form-control" value="{{ $product->name }}">
         </div>
         <div class="form-group">
             <label for="product-description">商品説明</label>
             <textarea name="description" id="product-description" class="form-control">{{ $product->description }}</textarea>
         </div>
         <div class="form-group">
             <label for="product-price">価格</label>
             <input type="number" name="price" id="product-price" class="form-control" value="{{ $product->price }}">
         </div>
         <div class="form-group">
             <label for="product-category">カテゴリ</label>
             <select name="category_id" class="form-control" id="product-category">
                 @foreach ($categories as $category)
                 @if ($category->id == $product->category_id)
                 <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                 @else
                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                 @endif
                 @endforeach
             </select>
         </div>
         <button type="submit" class="btn btn-danger">更新</button>
     </form>
 
     <a href="{{ route('products.index') }}">商品一覧に戻る</a>
 </div>
 @endsection
