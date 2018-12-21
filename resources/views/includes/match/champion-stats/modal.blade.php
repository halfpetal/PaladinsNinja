<div class="modal fade bd-example-modal-l"
    id="player-{{ $p['playerId'] }}"
    tabindex="-1"
    role="dialog" 
    aria-labelledby="myLargeModalLabel" 
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details for {{ $p['playerName'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-center row">
                <div class="col-4 mb-4">
                    <strong class="text-muted">Total Credits</strong> <br/>
                    <strong>{{ number_format($p['Gold_Earned']) }} ({{ number_format($p['Gold_Per_Minute']) }} CPM)</strong>
                </div>
                
                <div class="col-4 mb-4">
                    <strong class="text-muted">Damage Taken</strong> <br/>
                    <strong>{{ number_format($p['Damage_Taken']) }}</strong>
                </div>

                <div class="col-4 mb-4">
                    <strong class="text-muted">Damage Done</strong> <br/>
                    <strong>{{ number_format($p['Damage_Player']) }}</strong>
                </div>

                <div class="col-4 mb-4">
                    <strong class="text-muted">Objective Time</strong> <br/>
                    <strong>{{ number_format($p['Objective_Assists']) }}</strong>
                </div>

                
                <div class="col-4 mb-4">
                    <strong class="text-muted">Shielding</strong> <br/>
                    <strong>{{ number_format($p['Damage_Mitigated']) }}</strong>
                </div>

                <div class="col-4 mb-4">
                    <strong class="text-muted">Healing</strong> <br/>
                    <strong>{{ number_format($p['Healing']) }}</strong>
                </div>

                <div class="col-4 mb-4">
                    <strong class="text-muted">Killing Streak</strong> <br/>
                    <strong>{{ number_format($p['Killing_Spree']) }}</strong>
                </div>

                <div class="col-4 mb-4">
                    <strong class="text-muted">Kills</strong> <br/>
                    <strong>{{ number_format($p['Kills_Player']) }}</strong>
                </div>

                <div class="col-4 mb-4">
                    <strong class="text-muted">Deaths</strong> <br/>
                    <strong>{{ number_format($p['Deaths']) }}</strong>
                </div>

                <div class="col-4 mb-4">
                    <strong class="text-muted">Assists</strong> <br/>
                    <strong>{{ number_format($p['Assists']) }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>