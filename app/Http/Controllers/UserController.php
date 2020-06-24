<?php

namespace App\Http\Controllers;


use App\Http\Requests\EditUserValidateRequest;
use App\Http\Requests\NewUserValidateRequest;
use App\Models\Company;
use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function index() {
        $listUser = User::paginate(5);
        return view('user', ['users' => $listUser]);
    }

    public function create() {
        //get list company
        $listCompany = Company::all();
        return view('new-user', ['companies' => $listCompany]);
    }

    public function store(NewUserValidateRequest $request) {
        $user = new User;
        $user->createUserWithAvatar($request);

        return redirect()->back()->with(["success" => $request->login_id]);
    }

    public function show(User $user) {
        return view('show-user', ['user' => $user]);
    }

    public function edit(User $user) {
        $listCompany = Company::all();
        return view('edit-user', ["user" => $user,"companies" => $listCompany ]);
    }

    public function update(EditUserValidateRequest $request) {

        //update
        $updateUser = User::Where('id', $request->id)->firstOrFail();
        $updateUser->updateUserWithAvatar($request);

        return redirect(route("user.detail", $updateUser));
    }

    public function delete(User $user) {
        $user->delete();
        return redirect()->back();
    }
}
