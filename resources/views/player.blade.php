@extends('layouts.app')

@section('head')
<style>
    .container-fluid
    {
        padding-right: 150px !important;
        padding-left: 150px !important;
    }

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
        transition:background 0.05s linear;
    }
</style>
@endsection

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <player-page playername="{{ $player->name }}"></player-page>
</div>
@endsection
