<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SpatieRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'tools.loadout-builder.create', 'tools.loadout-builder.edit', 'tools.loadout-builder.delete',
            'tools.match.search.view',
            //'player.friends.view', 'player.status live.view', 'player.loadouts.view', 'player.match archives.view', 'player.statistics.view',
            'horizon.view', 
            'nova.view', 
            'super-admin'
        ];

        foreach($permissions as $p) {
            Permission::updateOrCreate(['name' => $p], ['name' => $p]);
        }
    }
}
