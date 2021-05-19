<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReminderQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder email to customer if quote is not paid';

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
