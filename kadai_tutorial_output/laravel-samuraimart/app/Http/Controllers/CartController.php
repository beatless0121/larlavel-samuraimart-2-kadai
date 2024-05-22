<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::instance(Auth::user()->id)->content();
 
         $total = 0;
 
         foreach ($cart as $c) {
             $total += $c->qty * $c->price;
         }
 
         return view('carts.index', compact('cart', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::instance(Auth::user()->id)->add(
            [
                'id' => $request->id, 
                'name' => $request->name, 
                'qty' => $request->qty, 
                'price' => $request->price, 
                'weight' => $request->weight, 
                'options' => [
                    'image' => $request->image,
                ]
            ] 
        );

        return to_route('products.show', $request->get('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_shoppingcarts = DB::table('shoppingcart')->where('instance', Auth::user()->id)->get();
        $count = $user_shoppingcarts->count();

        $count += 1;
        Cart::instance(Auth::user()->id)->store($count);

        DB::table('shoppingcart')->where('instance', Auth::user()->id)->where('number', null)->update(['number' => $count, 'buy_flag' => true]);

        Cart::instance(Auth::user()->id)->destroy();

        return to_route('carts.index');
    }
}
