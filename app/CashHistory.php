<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;

class CashHistory extends Model
{
    /**
     * @var string
     */
    protected $table = 'cash_history';

    /**
     * @var array
     */
    protected $fillable = [
        'cash_type',
        'sum',
        'cash_balance',
        'reason',
        'invoice_id'
    ];

    const CARD = 'CARD';
    const CASH = 'CASH';
    
    public function plusOrMinus(){
        echo '<pre>';
        if (preg_match( '/\+/', $this->reason)){
            dd($this->reason);
        }
    }
}
