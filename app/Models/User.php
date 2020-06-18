<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use PrimaryKeyTrait, FreshTimestampTrait;

    protected $dateFormat = 'U';
    public $incrementing = false;

    public function fromDateTime($value)
    {
        return $value; // Don't mutate our (int) on INSERT!
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function file() {
        return $this->belongsTo(File::class, "avatar");
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    /*
     * For soft-delete, we cant use pivot, so treat UserDevice as actual Eloquent and using
     * one-to-many in User.
     */
    public function user_device() {
        return $this->hasMany(UserDevice::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}
