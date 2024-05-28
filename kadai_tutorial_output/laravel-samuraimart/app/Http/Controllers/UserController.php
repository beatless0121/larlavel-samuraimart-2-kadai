<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Pagination\LengthAwarePaginator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();

        return view('users.mypage', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();
 
         return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
 
         $user->name = $request->input('name') ? $request->input('name') : $user->name;
         $user->email = $request->input('email') ? $request->input('email') : $user->email;
         $user->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $user->postal_code;
         $user->address = $request->input('address') ? $request->input('address') : $user->address;
         $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
         $user->update();
 
         return to_route('mypage');
    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if ($request->input('password') == $request->input('password_confirmation')) {
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } else {
            return to_route('mypage.edit_password');
        }

        return to_route('mypage');
    }

    public function edit_password()
    {
        return view('users.edit_password');
    }

    public function favorite()
    {
        $user = Auth::user();

        $favorites = $user->favorites(Product::class)->get();

        return view('users.favorite', compact('favorites'));
    }

    public function destroy(Request $request)
    {
        Auth::user()->delete();
        return redirect('/');
    }
    
    public function cart_history_index(Request $request)
     {
         $page = $request->page != null ? $request->page : 1;
         $user_id = Auth::user()->id;
         $billings = ShoppingCart::getCurrentUserOrders($user_id);
         $total = count($billings);
         $billings = new LengthAwarePaginator(array_slice($billings, ($page - 1) * 15, 15), $total, 15, $page, array('path' => $request->url()));
 
         return view('users.cart_history_index', compact('billings', 'total'));
     }

     public function cart_history_show(Request $request)
     {
         $num = $request->num;
         $user_id = Auth::user()->id;
         $cart_info = DB::table('shoppingcart')->where('instance', $user_id)->where('number', $num)->get()->first();
         Cart::instance($user_id)->restore($cart_info->identifier);
         $cart_contents = Cart::content();
         Cart::instance($user_id)->store($cart_info->identifier);
         Cart::destroy();
 
         DB::table('shoppingcart')->where('instance', $user_id)
             ->where('number', null)
             ->update(
                 [
                     'code' => $cart_info->code,
                     'number' => $num,
                     'price_total' => $cart_info->price_total,
                     'qty' => $cart_info->qty,
                     'buy_flag' => $cart_info->buy_flag,
                     'updated_at' => $cart_info->updated_at
                 ]
             );
 
         return view('users.cart_history_show', compact('cart_contents', 'cart_info'));
     }

     public function register_card(Request $request)
     {
         $user = Auth::user();
 
         $pay_jp_secret = env('PAYJP_SECRET_KEY');
         \Payjp\Payjp::setApiKey($pay_jp_secret);
 
         $card = [];
         $count = 0;
 
         if ($user->token != "") {
             $result = \Payjp\Customer::retrieve($user->token)->cards->all(array("limit"=>1))->data[0];
             $count = \Payjp\Customer::retrieve($user->token)->cards->all()->count;
 
             $card = [
                 'brand' => $result["brand"],
                 'exp_month' => $result["exp_month"],
                 'exp_year' => $result["exp_year"],
                 'last4' => $result["last4"] 
             ];
         }
 
         return view('users.register_card', compact('card', 'count'));
     }
 
     public function token(Request $request)
     {
         $pay_jp_secret = env('PAYJP_SECRET_KEY');
         \Payjp\Payjp::setApiKey($pay_jp_secret);
 
         $user = Auth::user();
         $customer = $user->token;
 
         if ($customer != "") {
             $cu = \Payjp\Customer::retrieve($customer);
             $delete_card = $cu->cards->retrieve($cu->cards->data[0]["id"]);
             $delete_card->delete();
             $cu->cards->create(array(
                 "card" => request('payjp-token')
             ));
         } else {
             $cu = \Payjp\Customer::create(array(
                 "card" => request('payjp-token')
             ));
             $user->token = $cu->id;
             $user->update();
         }
 
         return to_route('mypage');
     }
}
