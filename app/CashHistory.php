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
    
    public function addInvoice(Invoice $invoice){
        $cashHistory = new CashHistory();
        $previousBalance = CashHistory::orderby('created_at', 'desc')->first();
        switch ($invoice->type){
            case 'sales':
                $cashHistory->sum = $invoice->total_account;
                $cashHistory->cash_balance = $previousBalance + $cashHistory->sum;
                break;
            case 'purchase':
                $cashHistory->sum = $invoice->total_account;
                $cashHistory->cash_balance = $previousBalance - $cashHistory->sum;
                break;
            case 'writeOf':
                $cashHistory->sum = $invoice->total_account;
                $cashHistory->cash_balance = $previousBalance - $cashHistory->sum;
                break;
            case 'realisation':
                $cashHistory->sum = $invoice->total_account;
                $cashHistory->cash_balance = $previousBalance - $cashHistory->sum;
                break;
        }
        $cashHistory->save();
    }
}
