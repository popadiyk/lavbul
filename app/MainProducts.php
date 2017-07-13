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

    public function product()
    {
        return $this->hasOne(Product::class, 'marking', 'marking');
    }
}
