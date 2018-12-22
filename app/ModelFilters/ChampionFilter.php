<?php namespace PaladinsNinja\ModelFilters;

use EloquentFilter\ModelFilter;

class ChampionFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function role($role)
    {
        return $this->where('role', $role);
    }
}
