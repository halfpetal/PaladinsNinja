<?php namespace PaladinsNinja\ModelFilters;

use EloquentFilter\ModelFilter;

class MatchFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function region($region)
    {
        return $this->where('region', $region);
    }

    public function map($map)
    {
        return $this->where('map_game', $map);
    }

    public function gamemode($gamemode)
    {
        return $this->where('gamemode', $gamemode);
    }

    public function queue($queue)
    {
        return $this->where('queue_id', $queue);
    }
}
