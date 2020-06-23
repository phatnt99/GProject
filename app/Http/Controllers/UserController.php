<?php

namespace App\Http\Controllers;


use App\Http\Requests\NewUserValidateRequest;
use App\Models\Company;
use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index() {
        $listUser = User::paginate(5);
        return view('user', ['users' => $listUser]);
    }

    public function showStoreForm() {
        //get list company
        $listCompany = Company::all();
        return view('new-user', ['companies' => $listCompany]);
    }

    public function store(NewUserValidateRequest $request) {;
        $newFile = null;

        if($request->hasFile('avatar')) {
            //store image
            $path = $request->file('avatar')->store('user', 'public');

            //get information and save to array
            $infoImage = [
                'name' => $request->file('avatar')->getClientOriginalName(),
                'upload_name' => $request->file('avatar')->hashName(),
                'mime_type' => $request->file('avatar')->getMimeType(),
                'size' => $request->file('avatar')->getSize(),
                'disk' => 'public',
                'path' => 'storage/'.$path
            ];

            //save in File model
            $newFile = File::create($infoImage);
        }

        $newUser = new User;
        $newUser->fill($request->all());
        $newUser->avatar = $newFile->id;
        try {
            $newUser->saveOrFail();
        } catch (\Throwable $e) {
            return ddd("Error: ".$e);
        }
        return redirect()->back()->with(["success" => $request->login_id]);
    }
}
