<template>
    <div>
        <h4>Available Queues/Gamemodes</h4>
        <div class="d-flex flex-row mb-3">
            <div class="flex-column m-3" v-for="(value, key) in queues" :key="key">
                <button class="btn btn-outline-primary" v-on:click="setQueue(key)">{{ value }}</button>
            </div>
        </div>

        <div v-if="stats.length > 0" class="row">
            <div v-for="champ in stats" :key="champ.ChampionId" class="col-md-3 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">{{ champ.Champion }}</div>
                    <div class="card-body">
                        <p class="card-text">
                            <div class="row text-center">
                                <p class="col-6">
                                    <strong class="text-muted">W / L</strong> <br/>
                                    <strong>{{ champ.Wins }} / {{ champ.Losses }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">CREDITS</strong> <br/>
                                    <strong>{{ numberWithCommas(champ.Gold) }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">K / D / A</strong> <br/>
                                    <strong>{{ numberWithCommas(champ.Kills) }} / {{ numberWithCommas(champ.Deaths) }} / {{ numberWithCommas(champ.Assists) }}</strong>
                                </p>
                                
                                <p class="col-6">
                                    <strong class="text-muted">TIME PLAYED</strong> <br/>
                                    <strong>{{ minutesToHours(champ.Minutes) }}</strong>
                                </p>

                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <h4 v-else>No stats detected. Stats may not exist or you have not selected a queue/gamemode.</h4>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                stats: [],
                queues: {
                    '424': 'Siege',
                    '469': 'Team Deathmatch',
                    '452': 'Onslaught',
                    '486': 'Ranked KBM',
                    '428': 'Ranked Controller',
                    '488': 'End Times',
                    '445': 'Test Maps',
                }
            };
        },

        mounted() {
            //this.$router.replace({ params: { qid: 100}});
            if (this.$route.params.qid) {
                this.getQueue();
            }
        },

        methods: {
            sortAlpha(property) {
                return function(a, b) {
                    return a[property] >= b[property];
                };
            },

            getQueue() {
                axios.get('/api-player/v1/' + this.$route.params.id + '/queue/' + this.$route.params.qid)
                    .then(r => {
                        this.stats = r.data.sort(this.sortAlpha("Matches"));
                    });
            },

            minutesToHours(mins) {
                let h = Math.floor(mins / 60);
                let m = mins % 60;
                h = h < 10 ? '0' + h : h;
                m = m < 10 ? '0' + m : m;
                return `${h}H ${m}M`;
            },

            numberWithCommas(numberToParse) {
                return numberToParse.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },

            setQueue(id) {
                this.$router.replace({ params: { qid: id}});
                this.getQueue();
            }
        }
    }
</script>
