<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    
}
