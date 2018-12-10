<?php

namespace PaladinsNinja\Console\Commands;

use Illuminate\Console\Command;

class GetAllChampions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paladins:getchampions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and update all champions and their data in the system.';

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
        \PaladinsNinja\Jobs\ProcessAllChampions::dispatch()->onQueue('champions');
    }
}
