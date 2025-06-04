<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function showLoginForm()
        {
            return view('auth.employee-login');
        }
  
    public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');

            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->intended('/employee/dashboard');
            }

            return back()->withErrors(['email' => 'Invalid employee credentials']);
        }

    public function logout(Request $request)
        {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('employee.login');
        }
}
