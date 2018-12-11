@extends('layouts.app')

@section('head')
<style>
    .card-columns {
        column-count: 2;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col-sm col-sm-auto pr-0">
            <img class="card-img-left mt-4" src="{{ $champion->icon_url }}" height="125px"/>
        </div>

        <div class="col-sm px-0">
            <div class="card-body">
                <h2 class="card-title">{{ $champion->name }} <small class="text-muted">{{ $champion->role }}</small></h2>
                <p class="card-text">
                    <h4>{{ $champion->title  }}</h4>
                    <h5 class="text-muted">{{ $champion->onfreerotation ? 'On Free Rotation' : null }}</h5>
                </p>
            </div>
        </div>
    </div>
    <hr/>
    <div class="card-columns">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Info</h5>
                <div class="card-text row">
                    <div class="col-3">
                        <p>
                            <strong>Health</strong>
                            <br/>
                            {{ $champion->health }}
                        </p>

                        <p>
                            <strong>Speed</strong>
                            <br/>
                            {{ $champion->speed }}
                        </p>
                    </div>

                    <div class="col">
                        <p>
                            <strong>Lore</strong>
                            <br/>
                            {{ $champion->data['Lore'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Abilities</h5>
                <div class="card-text">
                    <div class="row w-100">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mt-4" src="{{ $champion->data['Ability_1']['URL'] }}" height="80px"/>
                        </div>

                        <div class="col-sm px-0">
                            <div class="card-body">
                                <h4 class="card-title">{{ $champion->data['Ability1'] }}</h4>
                                <p class="card-text">
                                    {{ $champion->data['Ability_1']['Description'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mt-4" src="{{ $champion->data['Ability_2']['URL'] }}" height="80px"/>
                        </div>

                        <div class="col-sm px-0">
                            <div class="card-body">
                                <h4 class="card-title">{{ $champion->data['Ability2'] }}</h4>
                                <p class="card-text">
                                    {{ $champion->data['Ability_2']['Description'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mt-4" src="{{ $champion->data['Ability_3']['URL'] }}" height="80px"/>
                        </div>

                        <div class="col-sm px-0">
                            <div class="card-body">
                                <h4 class="card-title">{{ $champion->data['Ability3'] }}</h4>
                                <p class="card-text">
                                    {{ $champion->data['Ability_3']['Description'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mt-4" src="{{ $champion->data['Ability_4']['URL'] }}" height="80px"/>
                        </div>

                        <div class="col-sm px-0">
                            <div class="card-body">
                                <h4 class="card-title">{{ $champion->data['Ability4'] }}</h4>
                                <p class="card-text">
                                    {{ $champion->data['Ability_4']['Description'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mt-4" src="{{ $champion->data['Ability_5']['URL'] }}" height="80px"/>
                        </div>

                        <div class="col-sm px-0">
                            <div class="card-body">
                                <h4 class="card-title">{{ $champion->data['Ability5'] }}</h4>
                                <p class="card-text">
                                    {{ $champion->data['Ability_5']['Description'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Talents</h5>
                <div class="card-text">
                    @foreach(array_where($champion->cards, function($value, $key) { return ($value['rarity'] == 'Legendary') && ($value['rank'] != 0);}) as $card)
                    <div class="row w-100">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mt-4" src="{{ $card['championCard_URL'] }}" height="80px"/>
                        </div>

                        <div class="col-sm px-0">
                            <div class="card-body">
                                <h4 class="card-title">{{ $card['card_name'] }}</h4>
                                <p class="card-text">
                                    {{ delete_all_between('[', '] ', $card['card_description']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cards</h5>
                <div class="card-text">
                    @foreach(array_where($champion->cards, function($value, $key) { return ($value['rarity'] != 'Legendary') && ($value['rank'] != 0);}) as $card)
                    <div class="row w-100">
                        <div class="col-sm col-sm-auto pr-0">
                            <img class="card-img-left mt-4" src="{{ $card['championCard_URL'] }}" height="80px"/>
                        </div>

                        <div class="col-sm px-0">
                            <div class="card-body">
                                <h4 class="card-title">{{ $card['card_name'] }}</h4>
                                <p class="card-text">
                                    {{ delete_all_between('[', '] ', $card['card_description']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
