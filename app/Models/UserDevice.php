<?php

namespace App\Models;

class UserDevice extends BaseModel

{
    public $table = "user_device";

    protected $guarded = [];

    protected $appends = ['loan_date', 'return_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    //Accessors
    public function getLoanDateAttribute()
    {
        return date("d/m/Y", $this->attributes['created_at']);
    }

    public function getReturnDateAttribute()
    {
        return $this->attributes['updated_at'] != $this->attributes['created_at'] ?
            date("d/m/Y", $this->attributes['updated_at']) : null;
    }
}
