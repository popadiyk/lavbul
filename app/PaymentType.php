<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{

    /**
     * @var string
     */
    protected $table = 'payment_types';

    /**
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
