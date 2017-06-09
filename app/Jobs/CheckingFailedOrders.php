<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Facades\OrderingFacade as MakerOrder;
use App\Invoice;

/**
 * Class CheckingFailedOrders
 * @package App\Jobs
 */
class CheckingFailedOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invoices = Invoice::ofType(Invoice::TYPE_SALES)
            ->ofStatus(Invoice::STATUS_CONFIRMED)
            ->isTimeToFailed()
            ->get();

        if(count($invoices) > 0) {
            MakerOrder::returnedProductToBase($invoices);
        }
    }
}
