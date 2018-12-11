<?php

namespace PaladinsNinja\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use PaladinsNinja\Models\Champion;

class ProcessAllChampions implements ShouldQueue
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
        $championData = resolve('PaladinsAPI')->getChampions();
        $cardData;
        $championModel = [];

        if (empty($championData)) {
            \Log::error('Could not obtain champion data.');
            return;
        }

        foreach ($championData as $champion) {
            $championModel = array_add($championModel, 'champion_id', $champion['id']);
            $championModel = array_add($championModel, 'health', $champion['Health']);
            $championModel = array_add($championModel, 'speed', $champion['Speed']);
            $championModel = array_add($championModel, 'onfreerotation', $champion['OnFreeRotation'] ? true : false);
            $championModel = array_add($championModel, 'name', $champion['Name']);
            $championModel = array_add($championModel, 'role', str_replace('Paladins ', '', $champion['Roles']));
            $championModel = array_add($championModel, 'title', $champion['Title']);
            $championModel = array_add($championModel, 'icon_url', $champion['ChampionIcon_URL']);
            $championModel = array_add($championModel, 'data', $champion);
            $championModel = array_add($championModel, 'cards', resolve('PaladinsAPI')->getChampionCards($champion['id']));

            \Log::info($champion);

            Champion::updateOrCreate(['champion_id' => $champion['id']], $championModel);

            $championModel = [];
        }
    }
}
