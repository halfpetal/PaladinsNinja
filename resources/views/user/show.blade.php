@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 text-center">
            <img src="{{ Gravatar::get($user->email, '2x') }}" alt="{{ properize($user->username) . ' Profile Picture' }}" class="img-rounded mb-5">

            <div class="card card-default">
                <div class="card-header">Profiles</div>
                <div class="card-body">
                    <a href="{{ route('player', ['player' => $user->paladins_player_id]) }}" title="Paladins Profile" class="btn btn-outline-secondary"><i class="fas fa-gamepad fa-2x"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="row">
                <h1 class="col">{{ $user->username }}</h1>

                @if(Auth::check() && $user->id == Auth::user()->id)
                <div class="col-3 float-right">
                    <a href="https://gravatar.com" target="_blank" class="btn btn-primary">Change Avatar</a>
                </div>
                @endif
            </div>

            <nav class="mb-4">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-wall-tab" data-toggle="tab" href="#nav-wall" role="tab" aria-controls="nav-wall" aria-selected="true">Wall</a>

                    <a class="nav-item nav-link" id="nav-reviews-made-tab" data-toggle="tab" href="#nav-reviews-made" role="tab" aria-controls="nav-reviews-made" aria-selected="false">Posted Reviews</a>

                    <a class="nav-item nav-link" id="nav-loadouts-tab" data-toggle="tab" href="#nav-loadouts" role="tab" aria-controls="nav-loadouts" aria-selected="false">Loadouts Built</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane container fade show active" id="nav-wall" role="tabpanel" aria-labelledby="nav-wall-tab">
                    <h4>Coming soon.</h4>
                </div>

                <div class="tab-pane container fade" id="nav-reviews-made" role="tabpanel" aria-labelledby="nav-reviews-made-tab">
                    <h4>Coming soon.</h4>
                </div>

                <div class="tab-pane container fade" id="nav-loadouts" role="tabpanel" aria-labelledby="nav-loadouts-tab">
                    @php
                    $loadouts = $user->loadouts()->orderBy('created_at', 'desc')->paginate();
                    @endphp

                    <div class="row">
                        @foreach($loadouts as $l)
                        <div class="card card-body mb-4 col-5 offset-1">
                            <h3>{{ $l->name }} <small class="text-muted">{{ $l->champion->name }}</small></h3>
                            <p>
                                {{ str_limit($l->description, 150) }}
                            </p>
                            
                            <a href="{{ route('tools.loadout-builder.show', ['loadout' => $l]) }}" class="btn btn-outline-primary">View Loadout</a>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-center">
                        {{ $loadouts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection