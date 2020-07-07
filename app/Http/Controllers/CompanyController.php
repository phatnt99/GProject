<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCompanyRequest;
use App\Http\Requests\NewCompanyRequest;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    //
    public function index(Request $request)
    {
        $listCompany = Company::when($request->name, function ($query) use ($request) {
            return $query->where('name', 'LIKE', "%".$request->name."%");
        })->when($request->address, function ($query) use ($request) {
            return $query->where('address', 'LIKE', "%".$request->address."%");
        })->when($request->email, function ($query) use ($request) {
            return $query->where('email', $request->email);
        })->when($request->url, function ($query) use ($request) {
            return $query->where('url', 'LIKE', "%".$request->url."%");
        })
                              ->orderBy('updated_at', 'desc')->paginate(5);

        $request->flash();

        return view('company', ['companies' => $listCompany]);
    }

    public function create()
    {
        return view('new-company');
    }

    public function store(NewCompanyRequest $request)
    {
        $company = new Company;
        $company->createCompany($request);

        return redirect()->back()->with(["success" => $request->name]);
    }

    public function edit(Company $company)
    {
        return view('edit-company', ["company" => $company]);
    }

    public function update(EditCompanyRequest $request)
    {
        //update
        $updateCompany = Company::Where('id', $request->id)->firstOrFail();
        $updateCompany->updateCompany($request);

        return redirect(route("company.edit", $updateCompany));
    }

    public function delete(Company $company)
    {
        $company->delete();

        return redirect()->back();
    }

    public function show() {
        //get company_id of current user
        $companyId = Auth::guard('user')->user()->company_id;
        $company = Company::where('id', $companyId)->first();

        return view('show-company', ['company' => $company]);
    }

    public function showListEmployee(Request $request) {
        //get company_id of current user
        $companyId = Auth::guard('user')->user()->company_id;
        $company = Company::where('id', $companyId)->first();
        //list user
        $listUser = $company->users()->when($request->login_id, function ($query) use ($request) {
            return $query->where('login_id', $request->login_id);
        })->when($request->email, function ($query) use ($request) {
            return $query->where('email', $request->email);
        })->when($request->first_name, function ($query) use ($request) {
            return $query->where('first_name', 'LIKE', '%'.$request->first_name.'%');
        })->when($request->last_name, function ($query) use ($request) {
            return $query->where('last_name', 'LIKE', '%'.$request->last_name.'%');
        })->when($request->age, function ($query) use ($request) {
            return $query->whereYear('birthday', Carbon::now()->year - $request->age);
        })->when($request->address, function ($query) use ($request) {
            return $query->where('address', 'LIKE', '%'.$request->address.'%');
        })->when($request->gender !== null, function ($query) use ($request) {
            return $query->where('gender', $request->gender);
        })->orderBy('updated_at', 'desc')->paginate(5);
        //list company
        $listCompany = Company::all();
        return view('employees-company', ['users' => $listUser, 'companies' => $listCompany]);
    }
}
