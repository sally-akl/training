<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
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

    protected $with = ['userroles'];

  public function role()
  {
      return $this->belongsTo('App\Role');
  }
  public function transactions()
  {
    return $this->hasMany('App\Transactions','trainer_id');
  }
  public function withdraws()
  {
    return $this->hasMany('App\Withdrow','trainer_id');
  }
  public function packages()
  {
    return $this->hasMany('App\Package','user_id');
  }
  public function userroles()
  {
    return $this->hasMany('App\UserRoles','user_id');
  }
  public function getPermissions()
  {
       $permissions = $this->userroles()->pluck('permssion_name')->toArray();
       return $permissions;
  }
}
