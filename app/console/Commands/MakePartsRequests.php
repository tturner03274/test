<?php

namespace App\Console\Commands;

use App\PartsRequest;
use Illuminate\Console\Command;

class MakePartsRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:parts-requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate test Parts Requests';

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
        PartsRequest::truncate();
        factory(PartsRequest::class, 55)->create();
    }
}
