@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                @foreach($loadouts as $loadout)
                <div class="col-12">
                        <div class="card card-body mb-4">
                            <h3>{{ $loadout->name }} <small class="text-muted">{{ $loadout->champion->name }}</small></h3>
                            <p>
                                {{ str_limit($loadout->description, 150) }}
                            </p>
                            
                            <a href="{{ route('tools.loadout-builder.show', ['loadout' => $loadout]) }}" class="btn btn-outline-primary">View Loadout</a>
                        </div>
                </div>
                @endforeach
            </div>

            {{ $loadouts->links() }}
        </div>

        <div class="col-md-4 col-sm-12">
            <a href="{{ route('tools.loadout-builder.create') }}" class="btn btn-outline-success btn-block mb-4">Create a Build</a>
            <div class="card">
                <div class="card-header">
                    Filtering
                </div>

                <div class="card-body">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter by Champion
                        </button>

                        <div class="dropdown-menu scrollable-menu">
                            <h6 class="dropdown-header">Champions</h6>
                            @foreach(\PaladinsNinja\Models\Champion::orderBy('name', 'asc')->get() as $champion)
                            <a class="dropdown-item" href="{{ route('tools.loadout-builder.index', ['champion' => $champion->champion_id]) }}">{{ $champion->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <hr>
                    <a href="{{ route('tools.loadout-builder.index') }}" class="btn btn-outline-primary btn-block">Remove Filtering</a> <br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection