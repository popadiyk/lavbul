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
 * @property int quantity
 * @method bool function isEnoughQty($qty)
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
     * Accessor for getting price from  date base
     *
     * @return float|int
     */
    public function getPriceAttribute()
    {
        return $this->attributes['price'] / 100;
    }

    /**
     * Accessor for setting price to date base
     *
     * @param $value
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Accessor for getting purchase_price from database
     *
     * @return float|int
     */
    public function getPurchasePriceAttribute()
    {
        return $this->attributes['purchase_price'] / 100;
    }

    /**
     * Accessor for setting purchase_price from data base
     *
     * @param $value
     */
    public function setPurchasePriceAttribute($value)
    {
        $this->attributes['purchase_price'] = $value* 100;
    }

    /**
     * This is relationship with group products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * THis is relationship with manufacture
     *
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
      return $this->price;
    }

    /**

    public function images()
    {
        return $this->hasMany('App\ProductPhoto');
    }


     * @param integer $delta
     */
    public function increaseQty($delta)
    {
        $this->quantity += $delta;
        $this->save();
    }

    /**
     * @param integer $delta
     * @return bool
     */
    public function decreaseQty($delta)
    {
        $this->quantity -= $delta;

        if($this->quantity < 0) {
           return false;
        }

        $this->save();

        return true;
    }

    /**
     * Checking for enough quantity of the product
     * @param $qty
     * @return bool
     */
    public function isEnoughQty($qty)
    {
        return $this->quantity < $qty ? false : true;
    }

}
