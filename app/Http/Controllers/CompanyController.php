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

        return redirect(route("company.edit", $updateCompany))->with('success', $updateCompany->name);
    }

    public function delete(Company $company)
    {
        $company->delete();

        return redirect()->back()->with('success', $company->name);
    }

}
