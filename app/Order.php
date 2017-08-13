<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 *
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'user_id',
        'name',
        'email',
        'cart',
        'payment_id',
        'delivery_id',
        'address',
        'status_id',
        'phone'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsConfirmed($query)
    {
        return $query->where('status_id', OrderStatus::CONFIRMED);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsUnconfirmed($query)
    {
        return $query->where('status_id', OrderStatus::UNCONFIRMED);
    }

    /**
     * Changing status_id of current order
     * @TODO To check input param
     * @param $status
     */
    public function changeStatus($status)
    {
        $this->status_id = $status;
        $this->save();
    }

    public function delivery(){
        return $this->hasOne(Delivery::class, 'id', 'delivery_id')->first()['title'];
    }
}
