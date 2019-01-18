<?php

namespace PaladinsNinja\Console\Commands;

use Illuminate\Console\Command;
use PaladinsNinja\Models\InGameItem;

class GetInGameItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paladins:getingameitems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all the items that can be purchased in game and store them to the database.';

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
        $items = resolve('PaladinsAPI')->getItems();

        foreach ($items as $item) {
            if ($item['champion_id'] != 0) {
                continue;
            }

            InGameItem::updateOrCreate(['ItemId' => $item['ItemId']], $item);
        }
    }
}
