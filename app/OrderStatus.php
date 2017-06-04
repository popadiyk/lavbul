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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'status_id', 'id');
    }
}
