<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    /**
     * @var string
     */
   protected $table = 'order_statuses';
    /**
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
