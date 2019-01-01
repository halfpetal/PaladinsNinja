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
    <div class="float-right">
        @if(\Request::get('role'))
            <a href="{{ route('champion.index') }}" class="btn btn-outline-primary btn-block">Remove Filtering</a> <br/>
        @endif
        <div class="btn-group">
            <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filtering / Sorting
            </button>

            <div class="dropdown-menu">
                <h6 class="dropdown-header">By Role</h6>
                <a class="dropdown-item" href="{{ route('champion.index', ['role' => 'damage']) }}">Damage</a>
                <a class="dropdown-item" href="{{ route('champion.index', ['role' => 'flanker']) }}">Flanker</a>
                <a class="dropdown-item" href="{{ route('champion.index', ['role' => 'front line']) }}">Front Line</a>
                <a class="dropdown-item" href="{{ route('champion.index', ['role' => 'support']) }}">Support</a>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($champions as $champion)
        <div class="col mb-5 text-center">
            <a href="{{ route('champion.show', ['champion' => $champion->champion_id]) }}" class="text-dark card-link">
                <div class="shadow-sm card" style="width:175px;">
                    <img class="card-img-top" src="{{ $champion->icon_url }}" height="175px">
                    <h4 class="card-header">
                        {{ $champion->name }}
                    </h4>
                    <span class="badge badge-dark">{{ $champion->role }}</span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
