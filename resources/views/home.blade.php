@extends('layouts.app')

@section('head')
<style>
    body {
        /*background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.55)), url('{{ asset('images/media/home/' . rand(1, 15) . '.png') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;*/
    }

    .container-fluid {
        padding-right: 0px;
        padding-left: 0px;
    }

    #particles-home canvas {
        background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.60));
        display: block;
        vertical-align: bottom;
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        opacity: 1;
        -webkit-transition: opacity .8s ease, -webkit-transform 1.4s ease;
        transition: opacity .8s ease, transform 1.4s ease
    }

    #particles-home {
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: -10;
        top: 0;
        left: 0
    }

</style>
@endsection

@section('content')
<div class="container-fluid mb-5">
    <div id="particles-home"></div>
    <div>
        <section class="pb-5 pt-3 text-center text-white">
            <img src="{{ asset('images/new-alt.png') }}" class="img-fluid" style="width:10%;"/>
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
    </div>
</div>
@endsection

@section('footer')
<script>
    particlesJS.load('particles-home', 'particles/home.json', function() {
        console.log('Home particles loaded.');
    });
</script>
@endsection