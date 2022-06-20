<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\Days;
use App\Models\Menu;
use App\Models\ProblemZone;
use App\Models\Training;
use App\Models\TrainingLocation;
use Illuminate\Http\Request;
use App\Models\MenuCalory;
use Illuminate\Support\Facades\Log;
use App\Models\MenuDays;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::with('menuDays')->get();
        return response()->json($menus);
    }

    public function store(MenuStoreRequest $request)
    {
        $menu = Menu::create($request->validated());

        return new MenuResource($menu);
    }

    public function show(Request $request, $menuId)
    {
        $menu = Menu::find($menuId);
        return new MenuResource($menu);
    }

    public function update(MenuUpdateRequest $request, $menuId)
    {
        $menu = Menu::find($menuId);
        $menu->update($request->validated());
        return new MenuResource($menu);
    }

    public function destroy(Request $request, $menuId)
    {
        $menu = Menu::find($menuId);
        $menu->delete();
        return response()->noContent();
    }

    function adminMenus(Request $request)
    {
        $menus = Menu::with('menuDays', 'menuCalories')->get();

        return view('admin.dashboard.menu.menuList')->with(compact('menus'));
    }
    function adminShowMenu(Request $request, $id)
    {
        $menu = Menu::find($id);
        $calories = MenuCalory::all();
        return view('admin.dashboard.menu.menuEditForm')->with(compact('menu', 'calories'));
    }

    public function adminEditMenu(Request $request, $id)
    {
        $menu = Menu::find($id);
        $input = $request->validate([
            'menu_calories_id' => 'required|integer',
            'menu_content' => 'required|string',
            'menu_price' => 'required',
            'proteins' => 'required',
            'fat' => 'required',
            'carbs' => 'required'
        ]);
        $menu->update($input);
        return redirect()->route('menu');
    }

    public function deleteMenu($id)
    {
        Menu::destroy($id);
    }

    function adminAddView(Request $request)
    {
        $calories = MenuCalory::all();
        return view('admin.dashboard.menu.menuAddForm')->with(compact('calories'));
    }

    public function adminAddMenu(Request $request)
    {
        $input = $request->validate([
            'menu_calories_id' => 'required|integer',
            'menu_content' => 'required|string',
            'menu_price' => 'required',
            'proteins' => 'required',
            'fat' => 'required',
            'carbs' => 'required'
        ]);
        Menu::create($input);
        return redirect()->route('menu');
    }

    function adminMenuDay(Request $request, $id)
    {
        $menus = (Menu::with('menuDays', 'menuCalories')->find($id));
        $calories = MenuCalory::all();
        //dd($trainings->toArray());
        return view('admin.dashboard.menu.oneDayMenu.menuShow', compact('menus', 'calories'));
    }

    function adminShowMenuDay(Request $request, $id)
    {
        $menu_day = (MenuDays::find($id));
        return view('admin.dashboard.menu.oneDayMenu.menuOneEditForm')->with(compact('menu_day'));
    }

    function adminEditMenuDay(Request $request, $id)
    {
        $info_text = $request->info_text;
        $videos = $request->videos;
        $foods = $request->foods;
        $proteins = $request->proteins;
        $fat = $request->fat;
        $carbs = $request->carbs;
        $day_number = $request->day_number;
        $name = $request->name;

        Log::info(print_r($request->toArray(), true));
        if ($info_text != null && $videos != null && $foods != null && $proteins != null && $fat != null && $carbs != null && $day_number != null && $name != null) {
            MenuDays::whereId($id)->update([
                'info' => json_encode($info_text),
                'videos' => json_encode($videos),
                'foods' => json_encode($foods),
                'proteins' => $proteins,
                'fat' => $fat,
                'carbs' => $carbs,
                'day_number' => $day_number,
                'name' => $name,
            ]);
        }
        return redirect()->route('menu');
    }


    function adminAddViewDay(Request $request, $id)
    {
        //$menu_days = MenuDays::where("menu_id", $id)->get();
        return view('admin.dashboard.menu.oneDayMenu.menuOneAddForm');//->with(compact('menu_days', 'id'));
    }

    function adminAddMenuDay(Request $request)
    {
        $info_text = $request->info_text;
        $videos = $request->videos;
        $foods = $request->foods;
        $proteins = $request->proteins;
        $fat = $request->fat;
        $carbs = $request->carbs;
        $day_number = $request->day_number;
        $name = $request->name;

        if ($info_text != null && $videos != null && $foods != null && $proteins != null && $fat != null && $carbs != null && $day_number != null && $name != null) {
            MenuDays::create([
                'info' => json_encode($info_text),
                'videos' => json_encode($videos),
                'foods' => json_encode($foods),
                'proteins' => $proteins,
                'fat' => $fat,
                'carbs' => $carbs,
                'day_number' => $day_number,
                'name' => $name,
            ]);
        }
        return redirect()->route('menu');
    }

    public function adminDeleteMenuDay(Request $request, $id)
    {
        $menu_day = (MenuDays::find($id));
        $menu_day->delete();

        return redirect()->route('menu');
    }

}
