<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    const VERIFIED_USER='1';
    const UNVERIFIED_USER='0';

    const ADMIN_USER='true';
    const REGUlAR_USER='false';

    use Notifiable;
    use SoftDeletes;
    protected $data=['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password','verified','verification_token','admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    /**
     * Set ten, email theo chuan
     * https://www.youtube.com/watch?v=lohl1kfoJc8
     */
    // public function setNameAttribute($name)
    // {
    //     $this->attributes['name']=strtolower($name);
    // }
    // public function getNameAttribute($name)
    // {
    //     return ucwords($name);
    // }
    // public function setEmailAttribute($email)
    // {
    //     $this->attributes['email']=strtolower($email);
    // }



    public function isVerified()
    {
        return $this->verified==User::VERIFIED_USER;
    }
    public function isAdmin()
    {
        return $this->admin==User::ADMIN_USER;
    }
    public static function generateVerificationCode()
    {
        return str_random(40);
    }
}
