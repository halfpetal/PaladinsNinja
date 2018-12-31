@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Results for '{{ $query }}'</h3>
    <h5 class="text-muted">The results show the platforms where the user is available.</h5>
    <hr/>

    @forelse($players as $p)
    @if($p['player_id'] != 0)
    <a href="{{ route('player', ['player' => $p['player_id']]) }}" class="btn btn-primary btn-lg">{{ $p['portal'] }}</a>
    @endif
    @empty
    <h5>No users with that name are found.</h5>
    @endforelse
</div>
@endsection