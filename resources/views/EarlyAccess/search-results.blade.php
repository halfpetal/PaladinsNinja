@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Results for '{{ $query }}'</h3>
    <h5 class="text-muted">The results show the platforms where the user is available.</h5>
    <hr/>

    @forelse($players as $p)
    @if($p['player_id'] != 0)
    <a href="{{ route('player', ['player' => $p['player_id']]) }}" class="m-2 btn btn-primary btn-lg">{{ $p['portal'] }}</a>
    @endif
    @empty
    <h5>No users with that name are found.</h5>
    @endforelse

    <div class="row mt-5">
        <div class="col">
            @include('includes.ad')
        </div>
        <div class="col">
            @include('includes.ad')
        </div>
    </div>
</div>
@endsection