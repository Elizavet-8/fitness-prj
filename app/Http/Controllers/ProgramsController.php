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
}
