<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
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

    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('admin.admin_change_password',compact('data'));
    }// end method

    public function AdminUpdatePassword(Request $request){
        
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
           
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
         
            $notification = array(
                'message' => 'The old and new password not mach please try agin',
                'alert-type'  => 'error'
            );

            return back()->with($notification);
        }
        // update new password 
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Admin Password updated successfuly!!!',
            'alert-type'  => 'success'
        );

        return back()->with($notification);
        


    }// end function method
   
}
