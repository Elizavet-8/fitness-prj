<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalAccountStoreRequest;
use App\Http\Requests\PersonalAccountUpdateRequest;
use App\Http\Resources\PersonalAccountCollection;
use App\Http\Resources\PersonalAccountResource;
use App\Models\MenuCalory;
use App\Models\PersonalAccount;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMenu;
use App\Models\Menu;
use App\Models\TrainingUser;

use Illuminate\Support\Facades\Auth;

class PersonalAccountController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $personalAccount = PersonalAccount::with('user')->where('user_id','=',$user)->first();
        return response()->json($personalAccount);
    }

    public function store(PersonalAccountStoreRequest $request)
    {
        $personalAccount = PersonalAccount::create($request->validated());
        return new PersonalAccountResource($personalAccount);
    }

    public function show(Request $request, $personalAccountId)
    {
        $user = Auth::user()->id;
        $personalAccount = PersonalAccount::where('user_id','=',$user)->first();
        return new PersonalAccountCollection($personalAccount);
    }

    public function update(PersonalAccountUpdateRequest $request, $personalAccountId)
    {
        $personalAccount = PersonalAccount::find($personalAccountId)->first();
        $personalAccount->update($request->validated());
        return response()->noContent();
    }

    public function destroy(Request $request, $personalAccountId)
    {
        $personalAccount = PersonalAccount::find($personalAccountId);
        $personalAccount->delete();
        return response()->noContent();
    }

    function adminUsers(Request $request)
    {
        $accounts = PersonalAccount::with('user')->get();
        $users_data = User::all();
        $user_menus = UserMenu::with('menu')->get();

        $user_trainings = TrainingUser::with('training')->get();

        //dd($user_menus);
        return view('admin.dashboard.admin.usersList')->with(compact('accounts', 'users_data', 'user_menus', 'user_trainings'));
    }




}
