<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use PrimaryKeyTrait, FreshTimestampTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        return $this->belongsTo("App\Models\File", "avatar");
    }

    public function company() {
        return $this->belongsTo("App\Models\Company", "company_id");
    }

    /*
     * For soft-delete, we cant use pivot, so treat UserDevice as actual Eloquent and using
     * one-to-many in User.
     */
    public function user_device() {
        return $this->hasMany("App\Models\UserDevice", "user_id");
    }

}
