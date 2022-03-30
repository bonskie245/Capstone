<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_fName',
        'user_lName',
        'email',
        'password',
        'role_id',
        'user_phoneNum',
        'user_address',
        'user_department',
        'user_description',
        'user_image',
        'user_gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->hasOne('App\Models\Role','id','role_id');
    }

    public function userAvatar($request){
        $image = $request->file('user_image');
        $name = $image->hashName();
        $destination = public_path('/images');
        $image->move($destination,$name);
        return $name;
    }

    public function patientAvatar($request){
        $image = $request->file('user_image');
        $name = $image->hashName();
        $destination = public_path('/profiles');
        $image->move($destination,$name);
        return $name;
    }
}
