<?php

namespace App\Console\Commands;

use App\Jobs\CheckingFailedOrders;
use Illuminate\Console\Command;

class solveReturnOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:solveReturnOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all non-payed orders and return the qty of products from such Invoice';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dispatch(new CheckingFailedOrders());
        $this->info('Done!');
    }
}
