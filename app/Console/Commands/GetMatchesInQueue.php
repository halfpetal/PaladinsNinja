<?php

namespace PaladinsNinja\Console\Commands;

use Illuminate\Console\Command;

class GetMatchesInQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paladins:getmatchesinqueue {queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all the matches in a queue on a 10 minute interval.';

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
        $time = \Carbon\Carbon::now('UTC')->subHour()->format('H,i');
        $matches = resolve('PaladinsAPI')->getMatchIdsByQueue($time, \Carbon\Carbon::now()->format('Y-m-d'), $this->argument('queue'));

        if($matches[0]['Match'] == null || $matches[0]['ret_msg'] == 'Invalid signature.') {
            $matches = resolve('PaladinsAPI')->getMatchIdsByQueue($time, \Carbon\Carbon::now()->format('Y-m-d'), $this->argument('queue'));
        }

        if(\App::environment('local')) {
            for ($i = 0; $i < 10; $i++) {
                $match = $matches[$i];
                
                \PaladinsNinja\Jobs\ProcessMatch::dispatch($match['Match'])->onQueue('matches');
            }
        } else {
            foreach ($matches as $match) {
                if (!is_null($match) && is_int($match['Match']) && $match['Match'] > 0) {
                    \PaladinsNinja\Jobs\ProcessMatch::dispatch($match['Match'])->onQueue('matches');
                }
            }
        }
    }
}
