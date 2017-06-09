<?php

namespace App;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 *
 * @property integer $id
 * @property string description
 * @property integer $price
 * @property Group $group
 * @property Manufacture $manufacture
 * @property ProductPhoto Collection $images
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
        'main_photo'
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
     * Get the identifier of Product
     *
     * @param null $options
     * @return int
     */
    public function getBuyableIdentifier($options = null)
    {
       return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @param null $options
     * @return mixed
     */
    public function getBuyableDescription($options = null)
    {
        return $this->description;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return integer
     */
    public function getBuyablePrice($options = null)
    {
      return $this->price / 100 ;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\ProductPhoto');
    }

}
