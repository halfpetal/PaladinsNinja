<h2>{!! ($match->winning_task_force == 1) ? '<span class="badge badge-success">Won</span>' : '<span class="badge badge-danger">Lost</span>' !!} Team 1 - {{ $match->task_force_1_score }} Points</h2>

<ul class="nav nav-pills mb-3" id="t1-pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="t1-stats-tab" data-toggle="pill" href="#t1-stats" role="tab" aria-controls="t1-stats" aria-selected="true">View Stats</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="t1-loadouts-tab" data-toggle="pill" href="#t1-loadouts" role="tab" aria-controls="t1-loadouts" aria-selected="false">View Loadouts</a>
    </li>
</ul>

<div class="tab-content" id="t1-pills-tabContent">
    <div class="tab-pane fade show active" id="t1-stats" role="tabpanel" aria-labelledby="t1-stats-tab">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Champion</th>
                    <th scope="col">Player</th>
                    <th scope="col">Account Level</th>
                    <th scope="col">Party</th>
                    <th scope="col">Credits</th>
                    <th scope="col">K / D / A</th>
                    <th scope="col">Streak</th>
                    <th scope="col">Objective Time</th>
                    <th scope="col">Damage</th>
                    <th scope="col">Shielding</th>
                    <th scope="col">Healing</th>
                </tr>
            </thead>

            <tbody>
                @foreach($match->task_force_1 as $p)
                @php
                    $c = \PaladinsNinja\Models\Champion::where('champion_id', $p['ChampionId'])->firstOrFail();
                    $player = \PaladinsNinja\Models\Player::where('player_id', $p['playerId'])->first();

                    $playerChamp = null;

                    if (isset($player)) {
                        $playerChamp = array_first($player->champion_ranks, function($value, $key) use ($p) {
                            return $value['champion_id'] == $p['ChampionId'];
                        }, null);
                    }
                @endphp

                <tr>
                    <td>
                        {{ $p['Reference_Name'] }}
                    </td>

                    <td>
                        <a href="/player/{{ $p['playerId'] }}">{{ $p['playerName'] }}</a> 
                    </td>

                    <td>
                        {{ $p['Account_Level'] }}
                    </td>

                    <td>
                    @if (array_has($parties, $p['PartyId']))
                    Party {{ $parties[$p['PartyId']]['display_id'] }}
                    @else
                        <em>No party</em>
                    @endif
                    </td>

                    <td>
                        {{ number_format($p['Gold_Earned']) }}
                    </td>

                    <td>
                        {{ $p['Kills_Player'] }} / {{ $p['Deaths'] }} / {{ $p['Assists'] }}
                    </td>

                    <td>
                        {{ number_format($p['Killing_Spree']) }}
                    </td>

                    <td>
                        {{ number_format($p['Objective_Assists']) }}
                    </td>

                    <td>
                        {{ number_format($p['Damage_Player']) }}
                    </td>

                    <td>
                        {{ number_format($p['Damage_Mitigated']) }}
                    </td>

                    <td>
                        {{ number_format($p['Healing']) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="tab-pane fade show" id="t1-loadouts" role="tabpanel" aria-labelledby="t1-loadouts-tab">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Champion</th>
                    <th scope="col">Player</th>
                    <th scope="col">Account Level</th>
                    <th scope="col">Party</th>
                    <th scope="col">Items</th>
                    <th scope="col">Loadout</th>
                </tr>
            </thead>

            <tbody>
                @foreach($match->task_force_1 as $p)
                @php
                    $c = \PaladinsNinja\Models\Champion::where('champion_id', $p['ChampionId'])->firstOrFail();
                    $player = \PaladinsNinja\Models\Player::where('player_id', $p['playerId'])->first();

                    $playerChamp = null;

                    if (isset($player)) {
                        $playerChamp = array_first($player->champion_ranks, function($value, $key) use ($p) {
                            return $value['champion_id'] == $p['ChampionId'];
                        }, null);
                    }
                @endphp

                <tr>
                    <td>
                        {{ $p['Reference_Name'] }}
                    </td>

                    <td>
                        <a href="/player/{{ $p['playerId'] }}">{{ $p['playerName'] }}</a> 
                    </td>

                    <td>
                        {{ $p['Account_Level'] }}
                    </td>

                    <td>
                    @if (array_has($parties, $p['PartyId']))
                    Party {{ $parties[$p['PartyId']]['display_id'] }}
                    @else
                        <em>No party</em>
                    @endif
                    </td>

                    <td>
                    @for ($i = 1; $i < 5; $i++)
                        @if ($p['ActiveId' . $i] > 0)
                        @php
                            $item = \PaladinsNinja\Models\InGameItem::where('ItemId', $p['ActiveId' . $i])->firstOrFail();
                        @endphp
                        <a href="#" title="{{ $item['DeviceName'] }} - Level {{ $p['ActiveLevel' . $i] + 1}}">
                            <img class="img-fluid rounded" style="max-width:15%;" src="{{ $item['itemIcon_URL'] }}" />
                        </a>
                        @endif
                    @endfor
                    </td>

                    <td>
                    @if($p['ItemId6'] > 0)
                    @php
                        $card = array_first($c->cards, function($v, $k) use ($c, $p) {
                            if ($p['ItemId6'] == $v['card_id1'] || $p['ItemId6'] == $v['card_id2']) {
                                return $v;
                            }
                        });
                    @endphp
                        <a href="#" data-toggle="tooltip" data-html="true" title="{{ $card['card_name'] }}<br/><br/><em>{{ delete_all_between('[', ']', $card['card_description']) }}</em>">
                            <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" style="max-width:8%;"/>
                        </a>
                    @endif
                    @for ($i = 1; $i < 6; $i++)
                        @if($p['ItemId' . $i] > 0)
                        @php
                            $card = array_first($c->cards, function($v, $k) use ($c, $p, $i) {
                                if ($p['ItemId' . $i] == $v['card_id1'] || $p['ItemId' . $i] == $v['card_id2']) {
                                    return $v;
                                }
                            });

                            $description = str_replace('{' . get_all_between('{', '}', $card['card_description']) . '}', calculate_card_scaling(get_all_between('{', '}', $card['card_description']), $p['ItemLevel' . $i]), $card['card_description']);

                        $description = delete_all_between('[', ']', $description);
                        @endphp
                        <a href="#" data-toggle="tooltip" data-html="true" title="{{ $card['card_name'] }} - Level {{ $p['ItemLevel' . $i] }}<br/><br/><em>{{ $description }}</em>">
                            <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" style="max-width:15%;" />
                        </a>
                        @endif
                    @endfor
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="py-2">
    <hr/>
</div>

<h2>{!! ($match->winning_task_force == 2) ? '<span class="badge badge-success">Won</span>' : '<span class="badge badge-danger">Lost</span>' !!} Team 2 - {{ $match->task_force_2_score }} Points</h2>

<ul class="nav nav-pills mb-3" id="t2-pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="t2-stats-tab" data-toggle="pill" href="#t2-stats" role="tab" aria-controls="t2-stats" aria-selected="true">View Stats</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="t2-loadouts-tab" data-toggle="pill" href="#t2-loadouts" role="tab" aria-controls="t2-loadouts" aria-selected="false">View Loadouts</a>
    </li>
</ul>

<div class="tab-content" id="t2-pills-tabContent">
    <div class="tab-pane fade show active" id="t2-stats" role="tabpanel" aria-labelledby="t2-stats-tab">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Champion</th>
                    <th scope="col">Player</th>
                    <th scope="col">Account Level</th>
                    <th scope="col">Party</th>
                    <th scope="col">Credits</th>
                    <th scope="col">K / D / A</th>
                    <th scope="col">Streak</th>
                    <th scope="col">Objective Time</th>
                    <th scope="col">Damage</th>
                    <th scope="col">Shielding</th>
                    <th scope="col">Healing</th>
                </tr>
            </thead>

            <tbody>
                @foreach($match->task_force_2 as $p)
                @php
                    $c = \PaladinsNinja\Models\Champion::where('champion_id', $p['ChampionId'])->firstOrFail();
                    $player = \PaladinsNinja\Models\Player::where('player_id', $p['playerId'])->first();

                    $playerChamp = null;

                    if (isset($player)) {
                        $playerChamp = array_first($player->champion_ranks, function($value, $key) use ($p) {
                            return $value['champion_id'] == $p['ChampionId'];
                        }, null);
                    }
                @endphp

                <tr>
                    <td>
                        {{ $p['Reference_Name'] }}
                    </td>

                    <td>
                        <a href="/player/{{ $p['playerId'] }}">{{ $p['playerName'] }}</a> 
                    </td>

                    <td>
                        {{ $p['Account_Level'] }}
                    </td>

                    <td>
                    @if (array_has($parties, $p['PartyId']))
                    Party {{ $parties[$p['PartyId']]['display_id'] }}
                    @else
                        <em>No party</em>
                    @endif
                    </td>

                    <td>
                        {{ number_format($p['Gold_Earned']) }}
                    </td>

                    <td>
                        {{ $p['Kills_Player'] }} / {{ $p['Deaths'] }} / {{ $p['Assists'] }}
                    </td>

                    <td>
                        {{ number_format($p['Killing_Spree']) }}
                    </td>

                    <td>
                        {{ number_format($p['Objective_Assists']) }}
                    </td>

                    <td>
                        {{ number_format($p['Damage_Player']) }}
                    </td>

                    <td>
                        {{ number_format($p['Damage_Mitigated']) }}
                    </td>

                    <td>
                        {{ number_format($p['Healing']) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="tab-pane fade show" id="t2-loadouts" role="tabpanel" aria-labelledby="t2-loadouts-tab">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Champion</th>
                    <th scope="col">Player</th>
                    <th scope="col">Account Level</th>
                    <th scope="col">Party</th>
                    <th scope="col">Items</th>
                    <th scope="col">Loadout</th>
                </tr>
            </thead>

            <tbody>
                @foreach($match->task_force_2 as $p)
                @php
                    $c = \PaladinsNinja\Models\Champion::where('champion_id', $p['ChampionId'])->firstOrFail();
                    $player = \PaladinsNinja\Models\Player::where('player_id', $p['playerId'])->first();

                    $playerChamp = null;

                    if (isset($player)) {
                        $playerChamp = array_first($player->champion_ranks, function($value, $key) use ($p) {
                            return $value['champion_id'] == $p['ChampionId'];
                        }, null);
                    }
                @endphp

                <tr>
                    <td>
                        {{ $p['Reference_Name'] }}
                    </td>

                    <td>
                        <a href="/player/{{ $p['playerId'] }}">{{ $p['playerName'] }}</a> 
                    </td>

                    <td>
                        {{ $p['Account_Level'] }}
                    </td>

                    <td>
                    @if (array_has($parties, $p['PartyId']))
                    Party {{ $parties[$p['PartyId']]['display_id'] }}
                    @else
                        <em>No party</em>
                    @endif
                    </td>

                    <td>
                    @for ($i = 1; $i < 5; $i++)
                        @if ($p['ActiveId' . $i] > 0)
                        @php
                            $item = \PaladinsNinja\Models\InGameItem::where('ItemId', $p['ActiveId' . $i])->firstOrFail();
                        @endphp
                        <a href="#" title="{{ $item['DeviceName'] }} - Level {{ $p['ActiveLevel' . $i] + 1}}">
                            <img class="img-fluid rounded" style="max-width:15%;" src="{{ $item['itemIcon_URL'] }}" />
                        </a>
                        @endif
                    @endfor
                    </td>

                    <td>
                    @if($p['ItemId6'] > 0)
                    @php
                        $card = array_first($c->cards, function($v, $k) use ($c, $p) {
                            if ($p['ItemId6'] == $v['card_id1'] || $p['ItemId6'] == $v['card_id2']) {
                                return $v;
                            }
                        });
                    @endphp
                        <a href="#" data-toggle="tooltip" data-html="true" title="{{ $card['card_name'] }}<br/><br/><em>{{ delete_all_between('[', ']', $card['card_description']) }}</em>">
                            <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" style="max-width:8%;"/>
                        </a>
                    @endif
                    @for ($i = 1; $i < 6; $i++)
                        @if($p['ItemId' . $i] > 0)
                        @php
                            $card = array_first($c->cards, function($v, $k) use ($c, $p, $i) {
                                if ($p['ItemId' . $i] == $v['card_id1'] || $p['ItemId' . $i] == $v['card_id2']) {
                                    return $v;
                                }
                            });

                            $description = str_replace('{' . get_all_between('{', '}', $card['card_description']) . '}', calculate_card_scaling(get_all_between('{', '}', $card['card_description']), $p['ItemLevel' . $i]), $card['card_description']);

                        $description = delete_all_between('[', ']', $description);
                        @endphp
                        <a href="#" data-toggle="tooltip" data-html="true" title="{{ $card['card_name'] }} - Level {{ $p['ItemLevel' . $i] }}<br/><br/><em>{{ $description }}</em>">
                            <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" style="max-width:15%;" />
                        </a>
                        @endif
                    @endfor
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>