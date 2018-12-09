@extends('layouts.app')

@section('head')
<style>

    nav > .nav.nav-tabs
    {
        border: none;
        color:#fff;
        background:#2d3436;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active
    {
        border: none;
        padding: 18px 25px;
        color:#fff;
        background:#2d3436;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus
    {
        border: none;
        background: #b2bec3;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                    <a class="nav-item nav-link" id="nav-champions-tab" data-toggle="tab" href="#nav-champions" role="tab" aria-controls="nav-champions" aria-selected="false">Champions</a>
                    <a class="nav-item nav-link" id="nav-matches-tab" data-toggle="tab" href="#nav-matches" role="tab" aria-controls="nav-matches" aria-selected="false">Matches</a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"></div>

                <div class="tab-pane fade show" id="nav-champions" role="tabpanel" aria-labelledby="nav-champions-tab">
                    <player-champions></player-champions>
                </div>

                <div class="tab-pane fade show" id="nav-matches" role="tabpanel" aria-labelledby="nav-matches-tab">
                    <player-matches></player-matches>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
