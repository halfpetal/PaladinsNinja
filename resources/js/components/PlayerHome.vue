<template>
    <div>
        <div v-if="'player_id' in player">
            <div class="card-columns">
                <!-- General Card -->
                <div class="card">
                    <div class="card-header">Player Info</div>

                    <div class="card-body text-center">
                        <p class="card-text">
                            <div class="row">
                                <p class="col-6">
                                    <strong class="text-muted">Player Name</strong> <br/>
                                    <strong>{{ player.name }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Platform</strong> <br/>
                                    <strong>{{ player.platform }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Account Level</strong> <br/>
                                    <strong>{{ player.level }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Region</strong> <br/>
                                    <strong>{{ player.region }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Unlocked Champions</strong> <br/>
                                    <strong>{{ player.mastery_level }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Last Seen</strong> <br/>
                                    <strong data-toggle="tooltip" :data-original-title="playerDatesDisplay.last_login_at.exact">{{ playerDatesDisplay.last_login_at.relative }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Registered</strong> <br/>
                                    <strong data-toggle="tooltip" :data-original-title="playerDatesDisplay.registered_at.exact">{{ playerDatesDisplay.registered_at.relative }}</strong>
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Last Profile Update</strong> <br/>
                                    <strong>{{ this.$moment(player.updated_at).fromNow() }}</strong>
                                </p>
                            </div>
                            <hr>
                            <div class="row">
                                <p class="col-6">
                                    <strong class="text-muted">Community Rating</strong> <br/>
                                    <strong><router-link :to="{ name: 'player.reviews' }" class="btn btn-outline-dark">{{ isNaN(parseFloat(player.average_community_rating)) ? '0': parseFloat(player.average_community_rating).toFixed(1) }} <i class="fas fa-star"></i></router-link></strong> 
                                </p>

                                <p class="col-6">
                                    <strong class="text-muted">Ninja Profile</strong> <br/>
                                    <strong v-if="player.ninja_username != null"><a :href="player.ninja_profile_link" class="btn btn-outline-dark"><i class="fas fa-user-ninja"></i> {{ `@${player.ninja_username}` }}</a></strong> 
                                    <strong v-else>Unclaimed</strong>
                                </p>
                            </div>
                        </p>
                    </div>
                </div>

                <!-- Playtime Card -->
                <div class="card">
                    <div class="card-header">Playtime</div>
                    <div class="text-center">
                        <p class="card-text">
                            <h3>{{ player.hours_played }}H</h3>
                        </p>
                    </div>
                </div>

                <!-- Matches Card -->
                <div class="card">
                    <div class="card-header">Matches</div>
                    <div class="text-center">
                        <p class="card-text">
                            <h3>{{ player.losses + player.wins }} ({{ player.wins }}W - {{ player.losses }}L)</h3>
                        </p>
                    </div>
                </div>

                <!-- Ranked Card -->
                <div class="card">
                    <div class="card-header">Ranked <span class="text-muted">Season {{ player.ranked_conquest['Season'] }}</span></div>
                        
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-start">
                            <img :src="'/images/ranked/' + player.tier_conquest + '.png'" class="mr-2">
                            <div class="text-left">
                                <h3>{{ ranked_tier_display(player.tier_conquest) }}</h3>
                                <div class="d-flex justify-content-around">
                                    <p class="pr-3 text-center">
                                        <strong class="text-muted">Current TP</strong> <br/>
                                        <strong>{{ player.ranked_conquest['Points'] }}</strong>
                                    </p>

                                    <p class="text-center">
                                        <strong class="text-muted">Wins / Losses</strong> <br/>
                                        <strong>{{ player.ranked_conquest['Wins'] }}W / {{ player.ranked_conquest['Losses'] }}L</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KDA Card -->
                <div class="card">
                    <div class="card-header">Kills / Deaths / Assists</div>

                    <div class="card-body text-center">
                        <p class="card-text">
                            <h3>
                                {{ numberWithCommas(sumOfObjectKey(player.champion_ranks, 'Kills')) }} / {{ numberWithCommas(sumOfObjectKey(player.champion_ranks, 'Deaths')) }} / {{ numberWithCommas(sumOfObjectKey(player.champion_ranks, 'Assists')) }}
                            </h3>
                            <h5 class="text-muted">
                                {{ Number((sumOfObjectKey(player.champion_ranks, 'Kills') + (sumOfObjectKey(player.champion_ranks, 'Assists') / 2)) / sumOfObjectKey(player.champion_ranks, 'Deaths')).toFixed(2) }} RATIO
                            </h5>
                        </p>
                    </div>
                </div>

                <!-- Player Status Card -->
                <div class="card">
                    <div class="card-header">Player Status</div>

                    <div class="card-body">
                        <player-status></player-status>
                    </div>
                </div>

                <!-- Profile Actions Card -->
                <div class="card">
                    <div class="card-header">Profile Actions</div>

                    <div class="card-body text-center">
                        <p class="card-text">
                            <button v-on:click="requestUpdate" class="btn btn-outline-primary">Request Profile Update</button>
                        </p>
                    </div>
                </div>

                <!-- Top 5 Champions Card -->
                <div class="card">
                    <div class="card-header">Top 5 Champions</div>

                    <div class="card-body text-center">
                        <div class="card-text d-flex flex-column justify-content-around">
                            <div v-for="index in 5" :key="index" v-if="player.champion_ranks[index - 1] != undefined" class="row w-100">
                                <div class="col-sm col-sm-auto pr-0">
                                    <img class="card-img-left mt-4" :src="getChampion(player.champion_ranks[index - 1].champion_id).icon_url" height="75px"/>
                                </div>

                                <div class="col-sm px-0 text-left">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ getChampion(player.champion_ranks[index - 1].champion_id).name }}</h5>
                                        <div class="card-text row">
                                            <p class="col-6 text-center">
                                                <strong class="text-muted">Level</strong> <br/>
                                                <strong>{{ player.champion_ranks[index - 1].Rank }}</strong>
                                            </p>

                                            <p class="col-6 text-center">
                                                <strong class="text-muted">Playtime</strong> <br/>
                                                <strong>{{ Math.floor(player.champion_ranks[index - 1].Minutes / 60) }}H {{ player.champion_ranks[index - 1].Minutes % 60 }}M</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>

            <h4 class="text-center">We're getting all the player details from the archives.</h4>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                player: [],
                playerDatesDisplay: [],
                champions: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },

        mounted() {
            this.mountEcho();
            this.getPlayer();
        },

        methods: {
            getPlayer() {
                axios.get('/api/player/' + this.$route.params.id + '/details')
                    .then(r => {
                        this.player = r.data.player;
                        this.playerDatesDisplay = r.data.playerDetailDisplay;
                        this.champions = r.data.champions;

                        this.$nextTick(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                    });
            },

            mountEcho() {
                this.$echo.channel('player.' + this.playerid)
                    .listen('PlayerUpdated', this.reloadRouter);
            },

            reloadRouter(payload) {
                this.$router.go();
            },

            requestUpdate() {
                axios.post('/api-player/v1/' + this.$route.params.id + '/update')
                    .then(r => {
                        this.$toasted.show(r.data.message, {
                            position: 'bottom-right',
                            duration: 5000,
                            closeOnSwipe: true,
                            action : {
                                text : 'Close',
                                onClick : (e, toastObject) => {
                                    toastObject.goAway(0);
                                }
                            },
                        })
                    });
            },

            getChampion(championId) {
                return this.champions.find(el => {
                    return championId == el.champion_id;
                });
            },

            sumOfObjectKey(obj, key) {
                let sum = 0;

                obj.forEach(el => {
                    if (key in el) {
                        sum += Number(el[key]);
                    }
                });

                return sum;
            },

            numberWithCommas(numberToParse) {
                return numberToParse.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },

            ranked_tier_display(tier) {
                switch (tier) {
                    case 1:
                        return 'Bronze V';
                    case 2:
                        return 'Bronze IV';
                    case 3:
                        return 'Bronze III';
                    case 4:
                        return 'Bronze II';
                    case 5:
                        return 'Bronze I';
                    case 6:
                        return 'Silver V';
                    case 7:
                        return 'Silver IV';
                    case 8:
                        return 'Silver III';
                    case 9:
                        return 'Silver II';
                    case 10:
                        return 'Silver I';
                    case 11:
                        return 'Gold V';
                    case 12:
                        return 'Gold IV';
                    case 13:
                        return 'Gold III';
                    case 14:
                        return 'Gold II';
                    case 15:
                        return 'Gold I';
                    case 16:
                        return 'Platinum V';
                    case 17:
                        return 'Platinum IV';
                    case 18:
                        return 'Platinum III';
                    case 19:
                        return 'Platinum II';
                    case 20:
                        return 'Platinum I'; 
                    case 21:
                        return 'Diamond V';
                    case 22:
                        return 'Diamond IV';
                    case 23:
                        return 'Diamond III';
                    case 24:
                        return 'Diamond II';
                    case 25:
                        return 'Diamond I';
                    case 26:
                        return 'Masters I';
                    case 27:
                        return 'Grandmaster';
                    default:
                        return 'Qualifying';
                }
            }
        }
    }
</script>

