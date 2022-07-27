<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function dashboard(Request $req)
    {
        return view('admin.dashboard', get_defined_vars());
    }

    public function profile()
    {
        return view('admin.profile.userprofile', get_defined_vars());
    }
    public function general(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'email' => 'required|email',
            'name' => 'required',
        ]);

        $user->name = $req->name;
        $user->email = $req->email;
        $user->ghl_api_key = $req->ghl_api_key;
        if ($req->photo) {
            $user->photo = uploadFile($req->photo, 'uploads/profile', $req->name);
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function password(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'current_password' => 'required|password',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);
        $user->password = bcrypt($req->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
