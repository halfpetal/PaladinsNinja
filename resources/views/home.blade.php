@extends('layouts.app')

@section('head')
<style>
    body {
        background: url('{{ asset('images/media/home/' . rand(1, 15) . '.png') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .container-fluid {
        padding-right: 0px;
        padding-left: 0px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <section class="pb-5 pt-3 text-center text-white">
        <h1>
            Paladins Ninja
        </h1>
        <h4>Specially designed for Paladins players.<br>Built on community feedback and needs.</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form role="form" action="{{ route('search') }}" method="POST">
            <div class="row no-gutters w-50 mt-5" style="margin-left:25%">
                {{ csrf_field() }}
                <div class="col">
                    <input name="platform" id="platform" type="hidden" value="pc">
                    <input class="form-control form-control-lg rounded-0" type="text" id="name" name="name" placeholder="Find a Player">
                </div>

                <div class="col-auto">
                    <button class="btn btn-lg btn-success rounded-0" type="submit">Search</button>
                </div>
            </div>
        </form>
    </section>

    <section class="pt-5">
        <div class="card text-white bg-dark mb-3">
            <div class="card-body d-flex justify-content-around text-center">
                <div class="col">
                    <h1>{{ \Cache::remember('site.totalmatches', 30, function() { return \PaladinsNinja\Models\Match::count(); }) }}+</h1>
                    <h5 class="text-muted">MATCHES STORED</h5>
                </div>

                <div class="col">
                    <h1>{{ \Cache::remember('site.totalplayers', 30, function() { return \PaladinsNinja\Models\Player::count(); }) }}+</h1>
                    <h5 class="text-muted">PLAYERS STORED</h5>
                </div>

                <div class="col">
                    <h1>{{ \Cache::remember('site.totalmatchestoday', 30, function() { return \PaladinsNinja\Models\Match::where('match_date', '>=', \Carbon\Carbon::today())->count(); }) }}+</h1>
                    <h5 class="text-muted">MATCHES TODAY</h5>
                </div>
            </div>
        </div>
    </section>

    
</div>
@endsection
