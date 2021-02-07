<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return view('profile', ["auth" => Auth::guard('admin')->user(), "isAdmin" => true]);
        } else {
            return view('profile', ["auth" => Auth::guard('user')->user(), "isAdmin" => false]);
        }
    }

    public function updateProfile(ProfileRequest $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->user()->updateAdmin($request);

            return back()->with(['success' => 'Update profile successfully!']);
        } else {
            Auth::guard('user')->user()->updateUser($request);

            return back()->with(['success' => 'Update profile successfully!']);
        }
    }

    public function filterChart(Request $request)
    {
        $dataSets = DB::table('users')
                      ->selectRaw('start_at, count(*) as soluong')
                      ->whereBetween('start_at', [$request->fromD, $request->toD])
                      ->groupBy('start_at')
                      ->get();
        $period = new DatePeriod(
            new DateTime($request->fromD),
            new DateInterval('P1D'),
            new DateTime($request->toD.' 23:59:59')
        );
        $temp = [];
        $dataSets = $dataSets->keyBy('start_at');
        foreach ($period as $key => $value) {
            if ($dataSets->contains('start_at', $value->format('Y-m-d'))) {
                array_push($temp, $dataSets->get($value->format('Y-m-d')));
            } else {
                array_push($temp, ["start_at" => $value->format('Y-m-d'), "soluong" => 0]);
            }
        }

        return response()->json($temp);
    }
}
