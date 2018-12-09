@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <form class="" role="form" action="{{ route('search') }}" method="POST">
                {{  csrf_field() }}
                <div class="card-body row no-gutters align-items-center">
                    <div class="col">
                        <input class="form-control form-control-lg rounded-0" type="text" id="name" name="name" placeholder="Find a Player">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success rounded-0" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
