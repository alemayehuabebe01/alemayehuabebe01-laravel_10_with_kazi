<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

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

    public function AdminProfile(){
      
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));
    }//end method
   
}
