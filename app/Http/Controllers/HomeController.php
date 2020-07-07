<?php

namespace App\Http\Controllers;

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
            return view('profile', ["admin" => Auth::guard('admin')->user()]);
        } else {
            return view('profile', ["user" => Auth::guard('user')->user()]);
        }
    }

    public function updateProfile(Request $request) {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->user()->updateAdmin($request);
            return back()->with(['success' => 'Update profile successfully!']);
        } else {

        }
    }
}
