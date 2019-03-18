<div class="row text-center mb-4">
    <div class="col">
        <strong class="text-muted">Damage Done</strong> <br/>
        <strong>{{ number_format($p['Damage_Player']) }}</strong>
    </div>
    <div class="col">
        <strong class="text-muted">Kills / Assists</strong> <br/>
        <strong>{{ number_format($p['Kills_Player']) }} / {{ number_format($p['Assists']) }}</strong>
    </div>
</div>