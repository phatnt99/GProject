<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('content');
    }

    public function profile()
    {
        if (Auth::guard('admin')->check()) {
            return view('profile', ["auth" => Auth::guard('admin')->user()]);
        } else {
            return view('profile', ["auth" => Auth::guard('user')->user()]);
        }
    }

    public function updateProfile(ProfileRequest $request) {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->user()->updateAdmin($request);
            return back()->with(['success' => 'Update profile successfully!']);
        } else {
            Auth::guard('user')->user()->updateUser($request);
            return back()->with(['success' => 'Update profile successfully!']);
        }
    }
}
