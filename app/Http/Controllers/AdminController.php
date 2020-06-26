<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditAdminRequest;
use App\Http\Requests\NewAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('checkAdmin');
    }

    public function index(Request $request)
    {
        $listAdmin = Admin::when($request->login_id, function ($query) use ($request) {
            return $query->where('login_id', $request->login_id);
        })->when($request->email, function ($query) use ($request) {
            return $query->where('email', $request->email);
        })->when($request->first_name, function ($query) use ($request) {
            return $query->where('first_name', 'LIKE', '%'.$request->first_name.'%');
        })->when($request->last_name, function ($query) use ($request) {
            return $query->where('last_name', 'LIKE', '%'.$request->last_name.'%');
        })->when($request->birthday, function ($query) use ($request) {
            return $query->where('birthday', $request->birthday);
        })->when($request->address, function ($query) use ($request) {
            return $query->where('address', 'LIKE', '%'.$request->address.'%');
        })->when($request->gender, function ($query) use ($request) {
            if ($request->gender == 0) {
                return null;
            } else {
                return $query->where('gender', $request->gender - 1);
            }
        })->orderBy('updated_at', 'desc')->paginate(5);

        $request->flash();

        return view('admin', ['admins' => $listAdmin]);
    }

    public function create()
    {
        return view('new-admin');
    }

    public function store(NewAdminRequest $request)
    {
        $admin = new Admin;
        $admin->createAdminWithAvatar($request);

        return redirect()->back()->with(["success" => $request->login_id]);
    }

    public function edit(Admin $admin)
    {
        return view('edit-admin', ["admin" => $admin]);
    }

    public function update(EditAdminRequest $request)
    {

        //update
        $updateAdmin = Admin::Where('id', $request->id)->firstOrFail();
        $updateAdmin->updateAdminWithAvatar($request);

        return redirect(route("admin.detail", $updateAdmin));
    }

    public function delete(Admin $admin)
    {
        $admin->delete();

        return redirect()->back();
    }
}
