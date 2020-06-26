<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\NewUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $listCompany = Company::all();
        $listUser = User::when($request->login_id, function ($query) use ($request) {
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
        })->when($request->company_id, function ($query) use ($request) {
            return $query->where('company_id', $request->company_id);
        })->when($request->position, function ($query) use ($request) {
            return $query->where('position', $request->position);
        })->when($request->code, function ($query) use ($request) {
            return $query->where('code', $request->code);
        })->when($request->start_at, function ($query) use ($request) {
            return $query->where('start_at', $request->start_at);
        })->when($request->end_at, function ($query) use ($request) {
            return $query->where('end_at', $request->end_at);
        })->orderBy('updated_at', 'desc')->paginate(5);

        // obtain old input
        $request->flash();

        return view('user', ['users' => $listUser, 'companies' => $listCompany]);
    }

    public function create()
    {
        //get list company
        $listCompany = Company::all();

        return view('new-user', ['companies' => $listCompany]);
    }

    public function store(NewUserRequest $request)
    {
        $user = new User;
        $user->createUserWithAvatar($request);

        return redirect()->back()->with(["success" => $request->login_id]);
    }

    public function edit(User $user)
    {
        $listCompany = Company::all();

        return view('edit-user', ["user" => $user, "companies" => $listCompany]);
    }

    public function update(EditUserRequest $request)
    {
        //update
        $updateUser = User::Where('id', $request->id)->firstOrFail();
        $updateUser->updateUserWithAvatar($request);

        return redirect(route("user.edit", $updateUser));
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}
