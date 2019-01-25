@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>
        {{ $tierlist->name }} 
        <small>
            {!! \Share::page('https://pcor.pw/t/' . $tierlist->identifier->identifier, 'Check out this tierlist for Paladins.', [], '<div>', '</div>')->facebook()->twitter()->whatsapp() !!}
        </small>
    </h1>



    <blockquote class="blockquote card card-body">
        <p class="mb-0">
            @if (isset($tierlist->description))
            {{ $tierlist->description }}
            @else
            No description provided.
            @endif
        </p>

        <footer class="blockquote-footer"><a href="{{ route('user.show', ['user' => $tierlist->user]) }}">{{ '@' . $tierlist->user->username }}</a></small></footer>
    </blockquote>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-1 border-right">
                        <h1>SS</h1>
                    </div>
                    <div class="col">
                        <div class="card-body p-0">
                            <div class="row">
                                @foreach($tierlist->tier_ss as $championId)
                                @php
                                    $champion = \PaladinsNinja\Models\Champion::where('champion_id', $championId)->firstOrFail();
                                @endphp

                                <div class="col">
                                    <div class="card" style="width:75px;height:75px;">
                                        <img src="{{ $champion->icon_url }}" class="card-img-top">
                                        <div class="champion-image-content w-100 text-center text-white">{{ $champion->name }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-1 border-right">
                        <h1>S</h1>
                    </div>
                    <div class="col">
                        <div class="card-body p-0">
                            <div class="row">
                                @foreach($tierlist->tier_s as $championId)
                                @php
                                    $champion = \PaladinsNinja\Models\Champion::where('champion_id', $championId)->firstOrFail();
                                @endphp

                                <div class="col">
                                    <div class="card" style="width:75px;height:75px;">
                                        <img src="{{ $champion->icon_url }}" class="card-img-top">
                                        <div class="champion-image-content w-100 text-center text-white">{{ $champion->name }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-1 border-right">
                        <h1>A</h1>
                    </div>
                    <div class="col">
                        <div class="card-body p-0">
                            <div class="row">
                                @foreach($tierlist->tier_a as $championId)
                                @php
                                    $champion = \PaladinsNinja\Models\Champion::where('champion_id', $championId)->firstOrFail();
                                @endphp

                                <div class="col">
                                    <div class="card" style="width:75px;height:75px;">
                                        <img src="{{ $champion->icon_url }}" class="card-img-top">
                                        <div class="champion-image-content w-100 text-center text-white">{{ $champion->name }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-1 border-right">
                        <h1>B</h1>
                    </div>
                    <div class="col">
                        <div class="card-body p-0">
                            <div class="row">
                                @foreach($tierlist->tier_b as $championId)
                                @php
                                    $champion = \PaladinsNinja\Models\Champion::where('champion_id', $championId)->firstOrFail();
                                @endphp

                                <div class="col">
                                    <div class="card" style="width:75px;height:75px;">
                                        <img src="{{ $champion->icon_url }}" class="card-img-top">
                                        <div class="champion-image-content w-100 text-center text-white">{{ $champion->name }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-1 border-right">
                        <h1>C</h1>
                    </div>
                    <div class="col">
                        <div class="card-body p-0">
                            <div class="row">
                                @foreach($tierlist->tier_c as $championId)
                                @php
                                    $champion = \PaladinsNinja\Models\Champion::where('champion_id', $championId)->firstOrFail();
                                @endphp

                                <div class="col">
                                    <div class="card" style="width:75px;height:75px;">
                                        <img src="{{ $champion->icon_url }}" class="card-img-top">
                                        <div class="champion-image-content w-100 text-center text-white">{{ $champion->name }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-1 border-right">
                        <h1>D</h1>
                    </div>
                    <div class="col">
                        <div class="card-body p-0">
                            <div class="row">
                                @foreach($tierlist->tier_d as $championId)
                                @php
                                    $champion = \PaladinsNinja\Models\Champion::where('champion_id', $championId)->firstOrFail();
                                @endphp

                                <div class="col">
                                    <div class="card" style="width:75px;height:75px;">
                                        <img src="{{ $champion->icon_url }}" class="card-img-top">
                                        <div class="champion-image-content w-100 text-center text-white">{{ $champion->name }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection