@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        {{ $loadout->name }} 
        <small class="text-muted">{{ $loadout->champion->name }}</small>
        <small>
            {!! \Share::page('https://pcor.pw/b/' . $loadout->identifier->identifier, 'Check out this loadout for Paladins.', [], '<div>', '</div>')->facebook()->twitter()->whatsapp() !!}
        </small>
    </h1>

    <blockquote class="blockquote card card-body">
        <p class="mb-0">
            @if (isset($loadout->description))
            {{ $loadout->description }}
            @else
            No description provided.
            @endif
        </p>

        <footer class="blockquote-footer"><a href="{{ route('user.show', ['user' => $loadout->user]) }}">{{ '@' . $loadout->user->username }}</a></small></footer>
    </blockquote>

    <div class="row text-center">
        @foreach($loadout->cards as $card)
        @php
        $c = array_first($loadout->champion->cards, function($value, $key) use ($card) {
            return $value['card_id1'] == $card['id'] || $value['card_id2'] == $card['id'];
        }, null);
        @endphp

        @if(isset($c))
        <div class="col-md-4 col-sm-12 mb-5">
        <div class="card">
            <img src="{{ $c['championCard_URL'] }}" class="card-img-top w-100">
            <div class="card-body">
                <div class="card-text">
                    <h4>{{ $c['card_name'] }} <small class="text-muted">{{ $card['points'] }} POINTS</small></h4>
                    @php
                        $description = str_replace('{' . get_all_between('{', '}', $c['card_description']) . '}', calculate_card_scaling(get_all_between('{', '}', $c['card_description']), $card['points']), $c['card_description']);

                        $description = delete_all_between('[', ']', $description);
                    @endphp
                    <p>
                        {{ $description }}
                    </p>

                    
                </div>
            </div>
        </div>
        </div>
        @else
        <p>Invalid card data.</p>
        @endif

        @endforeach
    </div>
</div>
@endsection