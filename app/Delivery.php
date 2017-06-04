<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    protected $table = 'deliveries';


    /**
     * @var array
     */
    protected $fillable = ['title', 'price'];


    public $timestamps = false;
}
