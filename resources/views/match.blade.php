@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-muted"><i>This page is a preview and is going under more testing and development. Please report any issues on the Discord server.</i></h4>

    <h2>{!! ($match->winning_task_force == 1) ? '<span class="badge badge-success">Won</span>' : '<span class="badge badge-danger">Lost</span>' !!} Team 1 - {{ $match->task_force_1_score }} Points</h2>

    <div class="card-columns">
        @forelse ($match->task_force_1 as $p)
        @php
            $c = \PaladinsNinja\Models\Champion::where('champion_id', $p['ChampionId'])->firstOrFail();
        @endphp
        <div class="card">

            <div class="card-body">
                <div class="card-title">
                    <h4>{{ $p['playerName'] }} <small class="text-muted">{{ $p['Reference_Name'] }}</small></h4>
                </div>
                
                <div class="card-body">
                    <div class="row w-100 mb-4">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mr-4" src="{{ $c['icon_url'] }}" height="65px"/>
                        </div>
                        <div class="col-sm px-0">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <strong class="text-muted">K / D / A</strong> <br/>
                                    <strong>{{ $p['Kills_Player'] }} / {{ $p['Deaths'] }} / {{ $p['Assists'] }}</strong>
                                </div>

                                <div class="col-6 text-center">
                                    <strong class="text-muted">CREDITS</strong> <br/>
                                    <strong>{{ number_format($p['Gold_Earned']) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <strong class="text-muted">LOADOUT</strong>
                        </div>

                        @if($p['ItemId6'] > 0)
                        @php
                            $card = array_first($c->cards, function($v, $k) use ($c, $p) {
                                if ($p['ItemId6'] == $v['card_id1'] || $p['ItemId6'] == $v['card_id2']) {
                                    return $v;
                                }
                            });
                        @endphp
                        <div class="col-3">
                            <a href="#" title="{{ $card['card_name'] }}">
                                <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" />
                            </a>
                        </div>
                        @endif

                        <div class="col">
                            <div class="row">
                                @for ($i = 1; $i < 6; $i++)
                                    @if($p['ItemId' . $i] > 0)
                                    @php
                                        $card = array_first($c->cards, function($v, $k) use ($c, $p, $i) {
                                            if ($p['ItemId' . $i] == $v['card_id1'] || $p['ItemId' . $i] == $v['card_id2']) {
                                                return $v;
                                            }
                                        });
                                    @endphp
                                    
                                    <div class="col-4 mb-3">
                                        <a href="#" title="{{ $card['card_name'] }} - Level {{ $p['ItemLevel' . $i] }}">
                                            <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" />
                                        </a>
                                    </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>

                    @switch(\PaladinsNinja\Enum\ChampionRole::getChampionRole($p['ChampionId']))
                        @case(\PaladinsNinja\Enum\ChampionRole::SUPPORT)
                            @include('includes.match.champion-stats.support', ['p' => $p, 'c' => $c])
                            @break
                        
                        @case(\PaladinsNinja\Enum\ChampionRole::DAMAGE)
                            @include('includes.match.champion-stats.damage', ['p' => $p, 'c' => $c])
                            @break
                        
                        @case(\PaladinsNinja\Enum\ChampionRole::FRONTLINE)
                            @include('includes.match.champion-stats.frontline', ['p' => $p, 'c' => $c])
                            @break

                        @case(\PaladinsNinja\Enum\ChampionRole::FLANK)
                            @include('includes.match.champion-stats.flank', ['p' => $p, 'c' => $c])
                            @break
                    @endswitch

                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#player-{{ $p['playerId'] }}">View All Stats</button>

                    @include('includes.match.champion-stats.modal', ['p' => $p, 'c' => $c])
                </div>
            </div>
        </div>
        @empty
        <h4>No players on team 1.</h4>
        @endforelse
    </div>
    
    <hr>

    <h2>{!! ($match->winning_task_force == 2) ? '<span class="badge badge-success">Won</span>' : '<span class="badge badge-danger">Lost</span>' !!} Team 2 - {{ $match->task_force_2_score }} Points</h2>

    <div class="card-columns">
        @forelse ($match->task_force_2 as $p)
        @php
            $c = \PaladinsNinja\Models\Champion::where('champion_id', $p['ChampionId'])->firstOrFail();
        @endphp
        <div class="card">

            <div class="card-body">
                <div class="card-title">
                    <h4>{{ $p['playerName'] }} <small class="text-muted">{{ $p['Reference_Name'] }}</small></h4>
                </div>
                
                <div class="card-body">
                    <div class="row w-100 mb-4">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mr-4" src="{{ $c['icon_url'] }}" height="65px"/>
                        </div>
                        <div class="col-sm px-0">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <strong class="text-muted">K / D / A</strong> <br/>
                                    <strong>{{ $p['Kills_Player'] }} / {{ $p['Deaths'] }} / {{ $p['Assists'] }}</strong>
                                </div>

                                <div class="col-6 text-center">
                                    <strong class="text-muted">CREDITS</strong> <br/>
                                    <strong>{{ number_format($p['Gold_Earned']) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <strong class="text-muted">LOADOUT</strong>
                        </div>

                        @if($p['ItemId6'] > 0)
                        @php
                            $card = array_first($c->cards, function($v, $k) use ($c, $p) {
                                if ($p['ItemId6'] == $v['card_id1'] || $p['ItemId6'] == $v['card_id2']) {
                                    return $v;
                                }
                            });
                        @endphp
                        <div class="col-3">
                            <a href="#" title="{{ $card['card_name'] }}">
                                <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" />
                            </a>
                        </div>
                        @endif

                        <div class="col">
                            <div class="row">
                                @for ($i = 1; $i < 6; $i++)
                                    @if($p['ItemId' . $i] > 0)
                                    @php
                                        $card = array_first($c->cards, function($v, $k) use ($c, $p, $i) {
                                            if ($p['ItemId' . $i] == $v['card_id1'] || $p['ItemId' . $i] == $v['card_id2']) {
                                                return $v;
                                            }
                                        });
                                    @endphp
                                    
                                    <div class="col-4 mb-3">
                                        <a href="#" title="{{ $card['card_name'] }} - Level {{ $p['ItemLevel' . $i] }}">
                                            <img class="img-fluid rounded" src="{{ $card['championCard_URL'] }}" />
                                        </a>
                                    </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>

                    @switch(\PaladinsNinja\Enum\ChampionRole::getChampionRole($p['ChampionId']))
                        @case(\PaladinsNinja\Enum\ChampionRole::SUPPORT)
                            @include('includes.match.champion-stats.support', ['p' => $p, 'c' => $c])
                            @break
                        
                        @case(\PaladinsNinja\Enum\ChampionRole::DAMAGE)
                            @include('includes.match.champion-stats.damage', ['p' => $p, 'c' => $c])
                            @break
                        
                        @case(\PaladinsNinja\Enum\ChampionRole::FRONTLINE)
                            @include('includes.match.champion-stats.frontline', ['p' => $p, 'c' => $c])
                            @break

                        @case(\PaladinsNinja\Enum\ChampionRole::FLANK)
                            @include('includes.match.champion-stats.flank', ['p' => $p, 'c' => $c])
                            @break
                    @endswitch

                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#player-{{ $p['playerId'] }}">View All Stats</button>

                    @include('includes.match.champion-stats.modal', ['p' => $p, 'c' => $c])
                </div>
            </div>
        </div>
        @empty
        <h4>No players on team 2.</h4>
        @endforelse
    </div>
</div>
@endsection