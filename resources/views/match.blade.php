@extends('layouts.app')

@php
$parties = [];
$currentParty = 1;

foreach ($match->task_force_1 as $p) {
    if (isset($p['PartyId']) && $p['PartyId'] > 0) {
        if (array_has($parties, $p['PartyId'])) {
            $party = $parties[$p['PartyId']];
        } else {
            $party = [
                'members' => [],
            ];

        }

        array_push($party['members'], $p['playerId']);

        $parties[$p['PartyId']] = $party;
    }
}

foreach ($match->task_force_2 as $p) {
    if (isset($p['PartyId']) && $p['PartyId'] > 0) {
        if (array_has($parties, $p['PartyId'])) {
            $party = $parties[$p['PartyId']];
        } else {
            $party = [
                'members' => [],
            ];
        }

        array_push($party['members'], $p['playerId']);

        $parties[$p['PartyId']] = $party;
    }
}

foreach ($parties as $key => $party) {
    if (count($party['members']) <= 1) {
        array_forget($parties, $key);
        continue;
    } else {
        $parties[$key] = array_add($party, 'display_id', $currentParty);
        $currentParty++;
    }
}
@endphp

@section('content')
<div class="container">
    <div class="card mb-5">
        <h5 class="card-header">Game Info</h5>

        <div class="card-body row text-center">
            <div class="col-3 mb-4">
                <strong class="text-muted">GAMEMODE</strong> <br/>
                <strong>{{ $match->gamemode }}</strong>
            </div>

            <div class="col-3 mb-4">
                <strong class="text-muted">MATCH TIME</strong> <br/>
                <strong>{{ floor($match->match_time_seconds / 60) }}M {{ $match->match_time_seconds % 60 }}S</strong>
            </div> 

            <div class="col-3 mb-4">
                <strong class="text-muted">MAP</strong> <br/>
                <strong>{{ delete_all_between('(', ')', str_replace(['LIVE ', 'Practice ', 'Ranked ', 'WIP '], '', $match->map_game)) }}</strong>
            </div> 

            <div class="col-3 mb-4">
                <strong class="text-muted">Region</strong> <br/>
                <strong>{{ $match->region }}</strong>
            </div> 

            <div class="col-3 mb-4">
                <strong class="text-muted">WINNING TEAM</strong> <br/>
                <strong>Team {{ $match->winning_task_force }}</strong>
            </div> 

            <div class="col-3 mb-4">
                <strong class="text-muted">TEAM 1 SCORE</strong> <br/>
                <strong>{{ $match->task_force_1_score }}</strong>
            </div> 

            <div class="col-3 mb-4">
                <strong class="text-muted">TEAM 2 SCORE</strong> <br/>
                <strong>{{ $match->task_force_2_score }}</strong>
            </div> 

            <div class="col-3 mb-4">
                <strong class="text-muted">MATCH DATE</strong> <br/>
                <strong data-toggle="tooltip" title="" data-original-title="{{ \Carbon\Carbon::parse($match->match_date)->toDayDateTimeString() }} UTC">{{ \Carbon\Carbon::parse($match->match_date)->diffForHumans() }}</strong>
            </div>

            @if (strcmp($match->gamemode, 'Ranked') == 0)
            <div class="col-3 mb-4">
                <strong class="text-muted">BANS</strong> <br/>
                <div class="row">
                    @php
                        $c1 = PaladinsNinja\Models\Champion::where('champion_id', $match->task_force_1[0]['BanId1'])->first();

                        $c2 = PaladinsNinja\Models\Champion::where('champion_id', $match->task_force_1[0]['BanId2'])->first();

                        $c3 = PaladinsNinja\Models\Champion::where('champion_id', $match->task_force_1[0]['BanId3'])->first();

                        $c4 = PaladinsNinja\Models\Champion::where('champion_id', $match->task_force_1[0]['BanId4'])->first();
                    @endphp

                    @if (isset($c1))
                    <div class="col-3 p-3">
                        <img src="{{ $c1->icon_url }}" class="img-fluid w-auto" title="{{ $c1->name }}">
                    </div>
                    @endif

                    @if (isset($c2))
                    <div class="col-3 p-3">
                        <img src="{{ $c2->icon_url }}" class="img-fluid w-auto" title="{{ $c2->name }}">
                    </div>
                    @endif

                    @if (isset($c3))
                    <div class="col-3 p-3">
                        <img src="{{ $c3->icon_url }}" class="img-fluid w-auto" title="{{ $c3->name }}">
                    </div>
                    @endif

                    @if (isset($c4))
                    <div class="col-3 p-3">
                        <img src="{{ $c4->icon_url }}" class="img-fluid w-auto" title="{{ $c4->name }}">
                    </div>
                    @endif
                </div>
            </div> 
            @endif
        </div>
    </div>

    @if(isset($tableView))
        @include('includes.match.view.table', ['match' => $match, 'parties' => $parties])
    @else
        @include('includes.match.view.panel', ['match' => $match, 'parties' => $parties])
    @endif
</div>
@endsection