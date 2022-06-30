<?php

namespace App\Http\Controllers;

use App\Models\MarathonAndProgram;
use App\Models\Menu;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramsController extends Controller
{
    public function openProgramsPage()
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $programs = MarathonAndProgram::all();
        return view('admin.dashboard.program.programList', compact('programs'));
    }

    public function openProgramEditingPage($id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $program = MarathonAndProgram::find($id);
        $trainings = Training::all();
        $menus = Menu::all();
        return view('admin.dashboard.program.programEditForm', compact('program', 'trainings', 'menus'));
    }

    public function editProgram(Request $request, $id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $program = MarathonAndProgram::find($id);
        $program->update($request->validate([
            'finish_date' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'menu_id' => 'required|integer',
            'training_id' => 'required|integer',
            'about_trainings' => 'nullable',
            'about_ration' => 'nullable',
            'about_procedures' => 'nullable',
            'about_support' => 'nullable',
            'about_motivation' => 'nullable',
            'stripe_id' => 'nullable'
        ]));
        return redirect()->route('openProgramsPage');
    }

    public function openAddingForm()
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $trainings = Training::all();
        $menus = Menu::all();
        return view('admin.dashboard.program.programAdd', compact( 'trainings', 'menus'));
    }

    public function addProgram(Request $request)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $input = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'finish_date' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'menu_id' => 'required|integer',
            'training_id' => 'required|integer',
            'about_trainings' => 'nullable',
            'about_ration' => 'nullable',
            'about_procedures' => 'nullable',
            'about_support' => 'nullable',
            'about_motivation' => 'nullable',
            'stripe_id' => 'nullable'
        ]);
        MarathonAndProgram::create($input);
        return redirect()->route('openProgramsPage');
    }

    public function deleteProgram($id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        MarathonAndProgram::destroy($id);
    }
}
