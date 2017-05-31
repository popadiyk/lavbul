<?php

namespace App;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 *
 * @property Group $group
 * @property Manufacture $manufacture
 */
class Product extends Model implements Buyable
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'group_id',
        'title',
        'purchase_price',
        'price',
        'manufacture_id',
        'quantity',
        'description',
        'marking',
    ];

    /**
     * This is relationship with group products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * THis is relationship with manufacture
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        dd('getBuyableIdentifier');
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        dd('getBuyableDescription');
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        dd('getBuyablePrice');
    }

}
