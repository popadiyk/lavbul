<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainProducts extends Model
{
    /**
     * @var string
     */
    protected $table = 'main_products';

    /**
     * @var array
     */
    protected $fillable = [
        'marking'
    ];
    
}
