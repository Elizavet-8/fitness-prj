<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutsController extends Controller
{
    public function prepareStripeCheckoutPage(Request $request)
    {
        $userInfo = json_decode($request->user_info);
        Session::put('user_info', $userInfo);
    }

    public function generateStripeCheckoutPage()
    {
        $userInfo = Session::get('user_info');
        if (is_null($userInfo))
            abort(404);
        $user = User::where('email', $userInfo->email)->first();
        $password = Str::random(12);
        if (is_null($user)) {
            $user = User::create([
                'name' => $userInfo->name,
                'email' => $userInfo->email,
                'password' => Hash::make($password)
            ]);
        }
        $checkout = $user->checkout($userInfo->stripe_id, [
            'success_url' => route('checkout-finish'),
            'cancel_url' => route('cancel-checkout')
        ]);
        return view('checkouts.stripe_page', [
            'checkout' => $checkout,
            'userInfo' => $userInfo
        ]);
    }

    public function cancelCheckout()
    {
        dd("cancel");
    }

    public function finishCheckout()
    {
        $userInfo = Session::get('user_info');
        if (is_null($userInfo))
            abort(404);
        $user = User::where('email', $userInfo->email)->first();
        $user->delete();
        $password = Str::random(12);
        $user = User::create([
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'password' => Hash::make($password)
        ]);
        dd([
            'user' => $user,
            'pwd' => $password
        ]);
    }
}
