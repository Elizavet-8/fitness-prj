<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\Days;
use App\Models\Menu;
use App\Models\MenuType;
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
        return view('admin.dashboard.menu.oneDayMenu.menuShow', compact('menus', 'calories'));
    }

    public function adminShowMenuDay(Request $request, $id)
    {
        $menu_day = (MenuDays::find($id));
        $menuTypes = MenuType::all();
        return view('admin.dashboard.menu.oneDayMenu.menuOneEditForm')->with(compact('menu_day', 'id', 'menuTypes'));
    }

    public function adminEditMenuDay(Request $request, $id)
    {
        $input = $request->validate([
            'menu_id' => 'required|integer',
            'content' => 'nullable',
            'info' => 'nullable',
            'videos' => 'nullable',
            'name' => 'required|string',
            'description' => 'required|string',
            'day_number' => 'required|integer',
            'proteins' => 'required',
            'fat' => 'required',
            'carbs' => 'required',
            'menu_type_id' => 'required|integer'
        ]);
        if (isset($input['content']))
            $input['content'] = $input['content'][0];
        if (isset($input['info']))
            $input['info'] = json_encode($input['info']);
        $menuDay = MenuDays::find($id);
        $menuDay->update($input);
        return redirect()->route('menu');
    }


    public function adminAddViewDay(Request $request, $id)
    {
        $menuTypes = MenuType::all();
        return view('admin.dashboard.menu.oneDayMenu.menuOneAddForm', compact('id', 'menuTypes'));//->with(compact('menu_days', 'id'));
    }

    public function adminAddMenuDay(Request $request)
    {
        $input = $request->validate([
            'menu_id' => 'required|integer',
            'content' => 'nullable',
            'info' => 'nullable',
            'videos' => 'nullable',
            'name' => 'required|string',
            'description' => 'required|string',
            'day_number' => 'required|integer',
            'proteins' => 'required',
            'fat' => 'required',
            'carbs' => 'required',
            'menu_type_id' => 'required|integer'
        ]);
        if (isset($input['content']))
            $input['content'] = $input['content'][0];
        if (isset($input['info']))
            $input['info'] = json_encode($input['info']);
        MenuDays::create($input);
        return redirect()->route('menu');
    }

    public function deleteMenuDay($id)
    {
        MenuDays::destroy($id);
    }

    public function adminDeleteMenuDay(Request $request, $id)
    {
        $menu_day = (MenuDays::find($id));
        $menu_day->delete();

        return redirect()->route('menu');
    }

}
