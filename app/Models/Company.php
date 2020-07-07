<?php

namespace App\Models;

class Company extends BaseModel
{
    //
    protected $table = 'companies';

    protected $guarded = [];

    //Business logic
    public function createCompany($request)
    {
        $newLogo = null;

        if ($request->hasFile('img')) {
            $newLogo = File::createNewImage($request, 'company');
        }

        $this->fill($request->except('img'));
        $this->logo = $newLogo ? $newLogo->id : null;

        $this->save();
    }

    public function updateCompany($request)
    {
        //detect if user change avatar
        if ($request->hasFile('img')) {
            $newLogo = File::updateImage($request, $this, "company");

            $this->fill($request->except('img'));
            $this->logo = $newLogo->id;
            $this->save();
        } else {
            $this->update($request->except('img'));
        }
    }

    //Relationship
    public function file()
    {
        return $this->belongsTo(File::class, "logo");
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
