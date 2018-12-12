@extends('layouts.app')

@section('head')
<style>
    .container-fluid
    {
        padding-right: 150px !important;
        padding-left: 150px !important;
    }

    nav > .nav.nav-tabs
    {
        border: none;
        color:#fff;
        background:#2d3436;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active
    {
        border: none;
        padding: 18px 25px;
        color:#fff;
        background:#2d3436;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus
    {
        border: none;
        background: #b2bec3;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                    <a class="nav-item nav-link" id="nav-champions-tab" data-toggle="tab" href="#nav-champions" role="tab" aria-controls="nav-champions" aria-selected="false">Champions</a>
                    <a class="nav-item nav-link" id="nav-matches-tab" data-toggle="tab" href="#nav-matches" role="tab" aria-controls="nav-matches" aria-selected="false">Matches</a>
                    <a class="nav-item nav-link" id="nav-friends-tab" data-toggle="tab" href="#nav-friends" role="tab" aria-controls="nav-friends" aria-selected="true">Friends</a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-columns">{{-- 
                        <div class="card">
                            <div class="card-header"></div>

                            <div class="card-body text-center">
                                <p class="card-text">
                                    
                                </p>
                            </div>
                        </div>
                        --}}

                        {{-- General Card --}}
                        <div class="card">
                            <div class="card-header">Player Info</div>

                            <div class="card-body text-center">
                                <p class="card-text">
                                    <div class="row">
                                        <p class="col-6">
                                            <strong class="text-muted">Player Name</strong> <br/>
                                            <strong>{{ $player->name }}</strong>
                                        </p>

                                        <p class="col-6">
                                            <strong class="text-muted">Platform</strong> <br/>
                                            <strong>{{ $player->platform }}</strong>
                                        </p>

                                        <p class="col-6">
                                            <strong class="text-muted">Account Level</strong> <br/>
                                            <strong>{{ $player->level }}</strong>
                                        </p>

                                        <p class="col-6">
                                            <strong class="text-muted">Region</strong> <br/>
                                            <strong>{{ $player->region }}</strong>
                                        </p>

                                        <p class="col-6">
                                            <strong class="text-muted">Unlocked Champions</strong> <br/>
                                            <strong>{{ $player->mastery_level }}</strong>
                                        </p>

                                        <p class="col-6">
                                            <strong class="text-muted">Last Seen</strong> <br/>
                                            <strong>{{ \Carbon\Carbon::parse($player->last_login_at)->diffForHumans() }}</strong>
                                        </p>

                                        <p class="col-6">
                                            <strong class="text-muted">Registered</strong> <br/>
                                            <strong>{{ \Carbon\Carbon::parse($player->registered_at)->diffForHumans() }}</strong>
                                        </p>

                                        <p class="col-6">
                                            <strong class="text-muted">Last Profile Update</strong> <br/>
                                            <strong>{{ \Carbon\Carbon::parse($player->updated_at)->diffForHumans() }}</strong>
                                        </p>
                                    </div>
                                </p>
                            </div>
                        </div>

                        {{-- Playtime Card --}}
                        <div class="card">
                            <div class="card-header">Playtime</div>
                            <div class="text-center">
                                <p class="card-text">
                                    <h3>{{ $player->hours_played }}H</h3>
                                </p>
                            </div>
                        </div>

                        {{-- Matches Card --}}
                        <div class="card">
                            <div class="card-header">Matches</div>
                            <div class="text-center">
                                <p class="card-text">
                                    <h3>{{ $player->losses + $player->wins }} ({{ $player->wins }}W - {{ $player->losses }}L)</h3>
                                </p>
                            </div>
                        </div>

                        {{-- Ranked Card --}}
                        <div class="card">
                            <div class="card-header">Ranked <span class="text-muted">Season {{ $player->ranked_conquest['Season'] }}</span></div>
                                
                            <div class="card-body">
                                <div class="card-text d-flex justify-content-start">
                                    <img src="{{ asset('images/ranked/' . $player->tier_conquest . '.png') }}" class="mr-0">
                                    <div class="text-left">
                                        <h3>{{ ranked_tier_display($player->tier_conquest) }}</h3>
                                        <div class="d-flex justify-content-around">
                                            <p class="pr-3 text-center">
                                                <strong class="text-muted">Current TP</strong> <br/>
                                                <strong>{{ $player->ranked_conquest['Points'] }}</strong>
                                            </p>

                                            <p class="text-center">
                                                <strong class="text-muted">Wins / Losses</strong> <br/>
                                                <strong>{{ $player->ranked_conquest['Wins'] }}W / {{ $player->ranked_conquest['Losses'] }}L</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- KDA Card --}}
                        <div class="card">
                            <div class="card-header">Kills / Deaths / Assists</div>

                            <div class="card-body text-center">
                                <p class="card-text">
                                    <h3>{{ number_format(collect($player->champion_ranks)->sum('Kills')) }} / {{ number_format(collect($player->champion_ranks)->sum('Deaths')) }} / {{ number_format(collect($player->champion_ranks)->sum('Assists')) }}</h3>
                                    <h5 class="text-muted">{{ round((collect($player->champion_ranks)->sum('Kills') + (collect($player->champion_ranks)->sum('Assists') / 2)) / collect($player->champion_ranks)->sum('Deaths'), 2) }} RATIO</h5>
                                </p>
                            </div>
                        </div>

                        {{-- Player Status Card --}}
                        <div class="card">
                            <div class="card-header">Player Status</div>

                            <div class="card-body">
                                <player-status v-bind:playername="'{{ $player->name }}'" v-bind:playerid="'{{ $player->player_id }}'"></player-status>
                            </div>
                        </div>

                        {{-- Profile Actions Card --}}
                        <div class="card">
                            <div class="card-header">Profile Actions</div>

                            <div class="card-body text-center">
                                <p class="card-text">
                                    <form method="POST" action="{{ route('player.update', ['player' => $player->player_id]) }}">
                                        {{ csrf_field() }}
                                        <button role="submit" class="btn btn-outline-primary">Request Profile Update</button>
                                    </form>
                                </p>
                            </div>
                        </div>

                        {{-- Top Champion Card --}}
                        <div class="card">
                            <div class="card-header">Top 5 Champions</div>

                            <div class="card-body text-center">
                                <div class="card-text d-flex flex-column justify-content-around">
                                    @for ($i = 0; $i < 5; $i++)
                                    @php
                                        $champion = \PaladinsNinja\Models\Champion::where('champion_id', $player->champion_ranks[$i]['champion_id'])->first();
                                    @endphp
                                    <div class="row w-100">
                                        <div class="col-sm col-sm-auto pr-0">
                                            <img class="card-img-left mt-4" src="{{ $champion->icon_url }}" height="75px"/>
                                        </div>

                                        <div class="col-sm px-0 text-left">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $champion->name }}</h5>
                                                <div class="card-text row">
                                                    <p class="col-6 text-center">
                                                        <strong class="text-muted">Level</strong> <br/>
                                                        <strong>{{ $player->champion_ranks[$i]['Rank'] }}</strong>
                                                    </p>

                                                    <p class="col-6 text-center">
                                                        <strong class="text-muted">Playtime</strong> <br/>
                                                        <strong>{{ floor($player->champion_ranks[$i]['Minutes'] / 60) }}H {{ $player->champion_ranks[$i]['Minutes'] % 60 }}M</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="nav-champions" role="tabpanel" aria-labelledby="nav-champions-tab">
                    <player-champions v-bind:player="'{{ $player->name }}'"></player-champions>
                </div>

                <div class="tab-pane fade show" id="nav-matches" role="tabpanel" aria-labelledby="nav-matches-tab">
                    <player-matches v-bind:player="'{{ $player->name }}'"></player-matches>
                </div>

                <div class="tab-pane fade show" id="nav-friends" role="tabpanel" aria-labelledby="nav-friends-tab">
                    <div class="card">
                        <div class="card-header">Friends List</div>
                        
                        <div class="card-text p-4 row align-items-center">
                            @forelse ($player->friends as $friend)
                            <div class="col m-4">
                                <span><a href="{{ route('player', ['player' => $friend['player_id']]) }}" class="btn btn-outline-dark btn-lg">{{ $friend['name'] }}</a></span>
                            </div>
                            @empty
                            <h4>Account has no friends. Note: Console player friends list are not given to us.</h4>
                            @endforelse
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
