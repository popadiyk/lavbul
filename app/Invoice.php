<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 * @package App
 *
 * @property User client
 * @property User author
 * @property Order order
 * @property ProductMove Collection productMove
 * @property string type
 * @property string status
 * @property Product Collection product
 */
class Invoice extends Model
{
    /**
     * @var string
     */
    protected $table = 'invoices';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'client_id',
        'author_id',
        'status',
        'total_account',
    ];

    const TYPE_PURCHASE = 'purchase';
    const TYPE_SALES = 'sales';
    const TYPE_WRITE_OF = 'writeOf';
    const TYPE_REALISATION = 'realisation';

    const STATUS_UNCONFIRMED = 'unconfirmed';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CLOSED = 'closed';
    const STATUS_FAILED = 'failed';

    /**
     * Accessor for getting total_account from data base
     *
     * @return float|int
     */
    public function getTotalAccountAttribute()
    {
        return $this->attributes['total_account'] / 100;
    }

    /**
     * Accessor for setting total_account to data base
     *
     * @param $value
     */
    public function setTotalAccountAttribute($value)
    {
        $this->attributes['total_account'] = $value * 100;
    }

    /**
     * The relationship with orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    /**
     * The relationship with users (client)
     *
     * @TODO When type is writeOf then client only one static
     * @TODO It's a very bad method
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        if($this->type === self::TYPE_SALES) {
            return $this->belongsTo(User::class, 'client_id', 'id');
        }else if($this->type === self::TYPE_PURCHASE || $this->type === self::TYPE_REALISATION) {
            return $this->belongsTo(Manufacture::class, 'client_id', 'id');
        }else {
            return $this->belongsTo(User::class, 'client_id', 'id');
        }
    }

    /**
     * The relationship with users (author)
     *
     * Who is created invoices
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_moves', 'invoice_id', 'product_id');
    }

    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsTimeToFailed($query)
    {
        $date = Carbon::yesterday();

        return $query->where('updated_at', '<', $date);
    }

    /**
     * Change status current invoices
     *
     * @TODO to need solving the checking of input param
     * @param $status
     */
    public function changeStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function getType($type){
        switch ($type){
            case 'sales': return 'Продаж'; break;
            case 'purchase': return 'Закупівля'; break;
            case 'writeOf': return 'Списання'; break;
            case 'realisation': return 'Реалізація'; break;
        }
    }

    public function getStatus($status){
        switch ($status){
            case 'unconfirmed': return 'НЕ ПРОВЕДЕНА'; break;
            case 'confirmed': return 'СТВОРЕНА'; break;
            case 'closed': return 'УСПІШНА'; break;
            case 'failed': return 'ВІДМІНЕНА'; break;
        }
    }


    public function getDescription(){
        return '['.$this->productMove[0]->product->marking.'] '.$this->productMove[0]->product->title.'. . .';
    }

    /**
     * The relationship with ProductMove
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productMove()
    {
        return $this->hasMany(ProductMove::class, 'invoice_id', 'id');
    }


}
