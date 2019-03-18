@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                @foreach($tierlists as $tierlist)
                <div class="col-12">
                        <div class="card card-body mb-4">
                            <h3>{{ $tierlist->name }} </h3>
                            <p>
                                {{ str_limit($tierlist->description, 150) }}
                            </p>
                            
                            <a href="{{ route('tools.tierlist.show', ['tierlist' => $tierlist]) }}" class="btn btn-outline-primary">View Tierlist</a>
                        </div>
                </div>
                @endforeach

                <div class="col-12">
                    @include('includes.ad')
                </div>
            </div>

            {{ $tierlists->links() }}
        </div>

        <div class="col-md-4 col-sm-12">
            <a href="{{ route('tools.tierlist.create') }}" class="btn btn-outline-success btn-block mb-4">Create a Tierlist</a>
            <div class="card mb-5">
                <div class="card-header">
                    Filtering
                </div>

                <div class="card-body">
                    <span class="text-muted">No filtering available for tierlists.</span>
                </div>
            </div>

            @include('includes.ad')
        </div>
    </div>
</div>
@endsection