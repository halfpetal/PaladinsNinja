@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($status as $s)
    <h2 class="mb-4">{{ title_case($s['platform']) }} <span class="badge badge-{{ (strcasecmp($s['status'], 'up') === 0) ? 'success' : 'danger' }}">{{ title_case($s['status']) }}</span> <small class="text-muted">v{{ $s['version'] }}</small></h2>
    @endforeach
</div>
@endsection