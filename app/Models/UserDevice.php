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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        return date("H:i:s d/m/Y", $this->attributes['created_at']);
    }

    public function getReturnDateAttribute()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        return $this->attributes['updated_at'] != $this->attributes['created_at'] ?
            date("H:i:s d/m/Y", $this->attributes['updated_at']) : null;
    }
}
