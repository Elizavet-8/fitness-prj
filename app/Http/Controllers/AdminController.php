<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function openAdminDashboard()
    {
        if(is_null(Auth::guard('admin')->user()))
            return redirect()->route('adminLogin');
        return view('admin.dashboard.homepage');
    }

    public function openAdminLoginPage()
    {
        return view('admin.dashboard.auth-temp.login');
    }

    public function loginAsAdministrator(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->user()->role_id === 2)
                return redirect()->route('adminMain');
            return redirect()->refresh()->withErrors([
                'errors' => 'Введенные данные неверны. Попробуйте снова.'
            ]);
        }
        return redirect()->refresh()->withErrors([
            'errors' => 'Введенные данные неверны. Попробуйте снова.'
        ]);
    }
}
