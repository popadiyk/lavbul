<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mockery\CountValidator\Exception;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role_id', 'email', 'password', 'phone',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin() {

        $role = $this->role;

        return $role->name == 'admin' ? true : false;
    }

    public function isSuperUser()
    {
        $role = $this->role;

        return $role->name == 'super_user' ? true : false;
    }

    public function getClient(){
        return $this->hasOne(Client::class);
    }

    public function getDiscount(){
        if ($this->hasMany(Client::class)->first() != null){
            return (100 - $this->hasMany(Client::class)->first()->discount)/100;
        } else {
            return 1;
        }
    }

}