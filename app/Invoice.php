<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 * @package App
 *
 * @property User client
 * @property User author
 * @property Order order
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


    const PURCHASE = 'purchase';
    const SALES = 'sales';
    const WRITE_OF = 'writeOf';
    const REALISATION = 'realisation';

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        if($this->type === self::SALES) {
            return $this->belongsTo(User::class, 'client_id', 'id');
        }else if($this->type === self::PURCHASE || $this->type === self::REALISATION) {
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



}
