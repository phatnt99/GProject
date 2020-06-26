<?php

namespace App\Models;

class Company extends BaseModel
{
    //
    protected $table = 'companies';

    public function file()
    {
        return $this->belongsTo(File::class, "logo");
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
