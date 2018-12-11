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
    <div class="row">
        @foreach($champions as $champion)
        <div class="col mb-5 text-center">
            <a href="{{ route('champion', ['champion' => $champion->champion_id]) }}" class="text-dark card-link">
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
