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

    public function AdminProfileStore(Request $request){

            $id = Auth::user()->id;
            $data = User::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->phone = $request->phone;
            $data->address = $request->address;

            if ($request->file('photo')) {
                $file = $request->file('photo');
                @unlink(public_path('upload/admin_image/'.$data->photo));
                $filename = date('Ymdhi') . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_image'), $filename); // Assuming 'admin_image' is your directory path
                $data->photo = $filename; // Update the 'photo' attribute directly, not the whole $data array
            }

            $data->save();

            $notification = array(
                'message' => 'Admin profile updated successfuly',
                'alert-type'  => 'success'
            );

            return redirect()->back()->with($notification);
       



        
    }//end method
   
}
