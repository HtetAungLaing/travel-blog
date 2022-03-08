<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editPassword()
    {
        return view('profile.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "current_password" => "required",
            "new_password" => "required|min:8",
            "confirm_new_password" => "required|min:8|same:new_password"
        ]);
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'wrong password!']);
        }

        $user = User::find(auth()->id());
        $user->password = Hash::make($request->new_password);
        $user->update();
        Auth::logout();
        return redirect()->route('login');
    }

    public function editProfile()
    {
        return view('profile.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "name" => "required|min:4",
            "photo" => "nullable|file|mimes:png,jpeg,|max:5000"
        ]);

        $user = User::find(auth()->id());
        $user->name = $request->name;
        if ($request->hasFile('photo')) {
            if (auth()->user()->profile_photo !== "default-profile.png") {
                Storage::delete('public/misc/' . auth()->user()->profile_photo);
            }
            $file = $request->file('photo');
            $fileName = uniqid() . "-profile." . $file->extension();
            $file->storeAs('public/misc/', $fileName);
            $user->profile_photo = $fileName;
        }
        $user->update();
        return redirect()->back();
    }
}
