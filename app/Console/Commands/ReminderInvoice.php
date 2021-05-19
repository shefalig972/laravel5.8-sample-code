<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReminderInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder email to customer if invoice is not paid';

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
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
