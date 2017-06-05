<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /**
     * @var string
     */
    protected $table = 'deliveries';


    /**
     * @var array
     */
    protected $fillable = ['title', 'price'];

    /**
     * @var bool
     */
    public $timestamps = false;

    const SHOP = 1;
    const UKR_POST = 2;
    const NEW_POST = 3;
    const COURIER = 4;
}
