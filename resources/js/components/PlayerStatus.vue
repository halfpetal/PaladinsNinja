<template>
    <div>
        <div v-if="this.match.length > 0">
            <h2>In Game</h2>
            <hr>
            <div v-if="this.match.playerId != null">   
                <h4>Team 1</h4>
                <div v-for="player in match" v-bind:key="player.playerId">

                </div>
                <h4>Team 2</h4>
            </div>
            <h4 class="text-muted" v-else>
                Currently in a match that we can not track.
            </h4>
        </div>
        <h2 class="text-center" v-else>
            {{ this.status.status_string }}
        </h2>
    </div>
</template>

<script>
    export default {
        props: ['playername', 'playerid'],

        data() {
            return {
                status: [],
                match: []
            };
        },
        mounted() {
            this.getStatus();
        },

        methods: {
            getStatus() {
                axios.get('/api/player/' + this.playerid + '/status')
                    .then(r => {
                        this.status = r.data[0];

                        if (this.status.status === 3) {
                            this.getMatch();
                        }
                    });
            },

            getMatch() {
                axios.get('/api/player/' + this.playerid + '/' + this.status.Match + '/live')
                    .then(r => {
                        this.match = r.data;
                        this.getTeamOne();
                    });
            },

            getTeamOne() {
                this.match.filter(el => { 
                    console.log(el); 
                    return el; 
                });
            }
        }
    }
</script>
