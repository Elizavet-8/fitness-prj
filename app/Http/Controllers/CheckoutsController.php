<?php

namespace App\Http\Controllers;

use App\Core\AuthorizationMailer;
use App\Models\PersonalAccount;
use App\Models\TrainingUser;
use App\Models\User;
use App\Models\UserMenu;
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
        $personalAccount = PersonalAccount::create([
            'user_id' => $user->id,
            'age' => $userInfo->age,
            'life_style_id' => $userInfo->life_style_id,
            'problem_zone_id' => $userInfo->problem_zone_id,
            'training_location_id' => $userInfo->training_location_id,
            'menu_calories_id' => $userInfo->menu_calories_id
        ]);
        $userMenu = UserMenu::create([
            'user_id' => $user->id,
            'menu_id' => $userInfo->menu_id,
            'menu_type_id' => 1
        ]);
        $trainingUser = TrainingUser::create([
            'user_id' => $user->id,
            'training_location_id' => $userInfo->training_location_id,
            'training_id' => $userInfo->training_id
        ]);
        (new AuthorizationMailer())->sendAuthorizationMessage($user->email, $password);
        dd([
            'user' => $user,
            'pwd' => $password,
            'pa' => $personalAccount,
            'um' => $userMenu,
            'tu' => $trainingUser
        ]);
    }
}
