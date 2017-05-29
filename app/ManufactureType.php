<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManufactureType extends Model
{

   protected $table = 'manufacture_types';

    protected $fillable = ['title'];
}
