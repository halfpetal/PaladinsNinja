@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="" role="form" action="{{ route('search') }}" method="POST">
                {{  csrf_field() }}
                <div class="card-body row no-gutters align-items-center">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                {{--<button class="btn btn-outline-secondary dropdown-toggle rounded-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Platform</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="$('#platform').val('nintendo'); $(this).siblings('a').removeClass('active'); $(this).addClass('active');" href="#">Nintendo</a>
                                    <a class="dropdown-item active" onclick="$('#platform').val('pc'); $(this).siblings('a').removeClass('active'); $(this).addClass('active');" href="#">PC</a>
                                    <a class="dropdown-item" onclick="$('#platform').val('ps'); $(this).siblings('a').removeClass('active'); $(this).addClass('active');" href="#">PlayStation</a>
                                    <a class="dropdown-item" onclick="$('#platform').val('xbl'); $(this).siblings('a').removeClass('active'); $(this).addClass('active');" href="#">Xbox</a>
                                </div>--}}
                            </div>
                            <input name="platform" id="platform" type="hidden" value="pc">
                            <input class="form-control form-control-lg rounded-0" type="text" id="name" name="name" placeholder="Find a Player">
                        </div>
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
