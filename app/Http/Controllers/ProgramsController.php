<?php

namespace App\Http\Controllers;

use App\Models\MarathonAndProgram;
use App\Models\Menu;
use App\Models\Training;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function openProgramsPage()
    {
        $programs = MarathonAndProgram::all();
        return view('admin.dashboard.program.programList', compact('programs'));
    }

    public function openProgramEditingPage($id)
    {
        $program = MarathonAndProgram::find($id);
        $trainings = Training::all();
        $menus = Menu::all();
        return view('admin.dashboard.program.programEditForm', compact('program', 'trainings', 'menus'));
    }

    public function editProgram(Request $request, $id)
    {
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
            'about_motivation' => 'nullable'
        ]));
        return redirect()->route('openProgramsPage');
    }

    public function openAddingForm()
    {
        $trainings = Training::all();
        $menus = Menu::all();
        return view('admin.dashboard.program.programAdd', compact( 'trainings', 'menus'));
    }

    public function addProgram(Request $request)
    {
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
            'about_motivation' => 'nullable'
        ]);
        MarathonAndProgram::create($input);
        return redirect()->route('openProgramsPage');
    }

    public function deleteProgram($id)
    {
        MarathonAndProgram::destroy($id);
    }
}
