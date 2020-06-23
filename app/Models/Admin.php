<?php

namespace App\Models;


use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Auth
{
    //
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'login_id', 'email', 'password',
    ];
    public function getId()
    {
        return $this->id;
    }

    public function file() {
        return $this->belongsTo(File::class, "avatar", "id");
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    //Accessors
    public function getNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
