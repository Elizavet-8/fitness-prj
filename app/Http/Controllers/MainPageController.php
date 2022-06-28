<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainPage;
use App\Models\MarathonAndProgram;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    function index(Request $request)
    {
        $main_welcome = MainPage::where('name','=','main_welcome')->first();
        $address_us_if = MainPage::where('name','=','address_us_if')->first();

        $marathons = MarathonAndProgram::all();

        return view('index')->with(compact('main_welcome','address_us_if', 'marathons'));
    }

    function adminEditContent(Request $request, $id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $name = $request->name;
        $content = $request->content;

        if($name!=null && $content!=null){
            MainPage::whereId($id)->update([
                'name' => $name,
                'content' => $answer
            ]);
        }
        return redirect()->route('adminMagePage');
    }

    function adminMagePage(Request $request)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $data = MainPage::all();
        return view('admin.dashboard.main.mainList')->with(compact('data'));
    }
}
