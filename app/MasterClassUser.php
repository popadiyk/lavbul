<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterClassUser extends Model
{
    protected $table = 'master_class_users';

    protected $fillable = [
        'name',
        'phone',
        'status'
    ];
}
