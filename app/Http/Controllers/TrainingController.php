<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingStoreRequest;
use App\Http\Requests\TrainingUpdateRequest;
use App\Http\Resources\TrainingCollection;
use App\Http\Resources\TrainingResource;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\TrainingLocation;
use App\Models\ProblemZone;
use App\Models\TrainingUser;
use App\Models\Days;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::with('days')->get();
        return response()->json($trainings);
    }

    public function store(TrainingStoreRequest $request)
    {
        $training = Training::create($request->validated());

        return new TrainingResource($training);
    }

    public function show(Request $request, $trainingId)
    {
        $training = Training::find($trainingId);
        return new TrainingResource($training);
    }

    public function update(TrainingUpdateRequest $request, $trainingId)
    {
        $training = Training::find($trainingId);
        $training->update($request->validated());
        return new TrainingResource($training);
    }

    public function destroy(Request $request, $trainingId)
    {
        $training = Training::find($trainingId);
        $training->delete();
        return response()->noContent();
    }

    function adminTrainings(Request $request)
    {
//        $trainings = Training::with('trainingDays', 'problemZone')->get();

        $trainings = Training::with('days', 'problemZone')->get();

        return view('admin.dashboard.workout.workoutList')->with(compact('trainings'));
    }

    function adminShowTraining(Request $request, $id)
    {
        $training = Training::find($id);
        $problem_zones = ProblemZone::all();
        return view('admin.dashboard.workout.workoutEditForm')->with(compact('training', 'problem_zones'));
    }

    function adminEditTraining(Request $request, $id)
    {
        $name = $request->name;
        $training_price = $request->training_price;
        $problemZone = $request->problemZone;

        if ($name != null && $training_price != null && $problemZone != null) {
            Training::whereId($id)->update([
                'name' => $name,
                'training_price' => $training_price,
                'problemZone' => $problemZone
            ]);
        }
        return redirect()->route('training');
    }

    function adminAddView(Request $request)
    {
        $locations = TrainingLocation::all();
        $problem_zones = ProblemZone::all();
        return view('admin.dashboard.workout.workoutAddForm')->with(compact('locations', 'problem_zones'));
    }

    function adminAddTraining(Request $request)
    {
        $name = $request->name;
        $training_price = $request->training_price;;
        $problemZone = $request->problem_zone_id;

        if ($name != null && $training_price != null && $problemZone != null) {
            Training::create([
                'name' => $name,
                'training_price' => $training_price,
                'problemZone' => $problemZone
            ]);
        }
        return redirect()->route('training');
    }

    //function adminDeleteTraining(Request $request, $id)
    //{
    //    $training = Training::where('id', '=', $id);
    //    $training->steps->delete();
    //    $training->delete();
    //    return redirect()->route('training');
    //}

//    function adminDeleteTraining(Request $request, $id)
//    {
//        //Training::where('id', '=', $id)->delete();
//
//        $training = Training::where('id', '=', $id);
//        $training_users = TrainingUser::where('id', '=', $id);
//        $training->trainingUser()->delete();
//        return redirect()->route('training');
//    }
//
    function adminTrainingsDay(Request $request, $id)
    {
        $trainings = (Training::with('trainingLocation', 'days')->find($id));
        $locations = TrainingLocation::all();

        //dd($trainings->toArray());
        return view('admin.dashboard.workout.oneDayTraining.workoutShow', compact('trainings', 'locations', 'id'));
    }

    function adminShowTrainingDay(Request $request, $id)
    {
        $training_day = (Days::find($id));
        $locations = TrainingLocation::all();
        return view('admin.dashboard.workout.oneDayTraining.workoutDayEditForm')->with(compact('training_day', 'locations', 'id'));
    }

    public function adminEditTrainingDay(Request $request, $id)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'training_location_id' => 'required|integer',
            'day_number' => 'required|integer',
            'description' => 'nullable',
            'videos' => 'nullable',
            'info' => 'nullable',
            'training_id' => 'required|integer'
        ]);
        $day = Days::find($id);
        $day->update($input);
        return redirect()->route('training');
    }

    public function openTrainingDayAdding($id)
    {
        $training_days = Days::all();
        $locations = TrainingLocation::all();
        return view('admin.dashboard.workout.oneDayTraining.workoutDayAddForm')->with(compact('training_days', 'locations', 'id'));
    }

    public function adminAddTrainingDay(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'training_location_id' => 'required|integer',
            'day_number' => 'required|integer',
            'description' => 'nullable',
            'videos' => 'nullable',
            'info' => 'nullable',
            'training_id' => 'required|integer'
        ]);
        Days::create($input);
        return redirect()->route('training');
    }

    public function adminDeleteTrainingDay(Request $request, $id)
    {
        $training_day = (Days::find($id));
        $training_day->delete();

        return redirect()->route('training');
    }

    public function deleteDay($id)
    {
        Days::destroy($id);
    }
}
