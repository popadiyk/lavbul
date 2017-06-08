<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductMove
 * @package App
 *
 * @property Product product
 * @property Invoice invoice
 * @property integer quantity
 */
class ProductMove extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_moves';

    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'invoice_id',
        'quantity',
        'sum'
    ];

    /**
     * The relationship with Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * The relationship with Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    /**
     * Accessor for getting sum from database
     *
     * @return float|int
     */
    public function getSumAttribute()
    {
        return $this->attributes['sum'] / 100;
    }

    /**
     * Accessor for setting sum to database
     * @param $value
     */
    public function setSumAttribute($value)
    {
        $this->attributes['sum'] = $value * 100;
    }

    /**
     * @param Product $product
     * @param $invoice_id
     * @param $quantity
     * @return bool
     */
    public function addProduct(Product $product, $invoice_id, $quantity)
    {
        $this->product_id= $product->id;
        $this->invoice_id = $invoice_id;
        $this->sum = $product->price;

        if($product->decreaseQty($quantity)) {
            $this->quantity = $quantity;
            $this->save();

            return true;
        }

        return false;
    }
}
