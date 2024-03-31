<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function AdminDashboard(){
    return view('admin.index');
    }//end method

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/Admin/login');
    }// end of the method

    public function AdminLogin(){
        return view('admin.admin_login');
    }//end of the method
   
}
