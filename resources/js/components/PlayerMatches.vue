<template>
    <div>
        <div v-if="matches.length > 0">
            <div v-for="match in this.matches" v-bind:key="match.match_id" v-if="match.map_game.indexOf('Practice') < 0" class="card mb-3">
                <div class="card-header">
                    <a data-toggle="collapse" :href="'#match-' + match.match_id" aria-expanded="false" role="button" :aria-controls="'match-' + match.match_id">
                        <span class="float-left">
                            {{ match.gamemode }} ( {{ match.map_game.replace('LIVE ', '').replace('WIP ', '').replace('Ranked ', '').replace('Practice ', '') }} ) - {{ match.region }} 
                        </span>

                        <span class="float-right">
                            {{ secondsToMinutes(match.match_time_seconds)  }} 
                        </span>
                    </a>
                </div>
                <div :id="'match-' + match.match_id" class="collapse">
                    <div class="card-block container mx-auto">
                        <div class="row">
                            <div class="col-12">
                                <a :href="'/match/' + match.match_id" class="btn btn-block btn-outline-dark">Preview Match Page</a>
                            </div>

                            <div class="col row border-right">
                                <div v-if="match.winning_task_force == 1" class="col-12 p-3 m-2 bg-success text-white text-center"><h3>WIN</h3></div>
                                <div v-else class="col-12 p-3 m-2 bg-danger text-white text-center"><h3>LOST</h3></div>    

                                <div class="col-12 card border-0 d-flex flex-row" v-for="player in match.task_force_1" v-bind:key="player.playerId">
                                    <div class="row w-100">
                                        <div class="col-sm col-sm-auto pr-0">
                                            <img class="card-img-left mt-4" :src="getChampion(player.ChampionId).icon_url" height="65px"/>
                                        </div>
                                        <div class="col-sm px-0">
                                            <div class="card-body">
                                                <h4 class="card-title"><a :href="'/player/' + player.playerId" class="btn btn-outline-dark">{{ player.playerName }}</a> - {{ player.Reference_Name }}</h4>
                                                <p class="card-text">
                                                    <div class="row">
                                                        <div class="col-6 text-center">
                                                            <strong class="text-muted">K / D / A</strong> <br/>
                                                            <strong>{{ player.Kills_Player }} / {{ player.Deaths }} / {{ player.Assists }}</strong>
                                                        </div>

                                                        <div class="col-6 text-center">
                                                            <strong class="text-muted">CREDITS</strong> <br/>
                                                            <strong>{{ numberWithCommas(player.Gold_Earned) }}</strong>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <strong class="text-muted">LOADOUT</strong>
                                                        </div>

                                                        <div  v-if="player.ItemId6 > 0" class="col-3">
                                                            <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId6).card_name"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId6).championCard_URL" /></a>
                                                        </div>

                                                        <div class="col">
                                                            <div class="row">
                                                                <div v-if="player.ItemId1 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId1).card_name + ' - Level ' + player.ItemLevel1"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId1).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId2 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId2).card_name + ' - Level ' + player.ItemLevel2"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId2).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId3 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId3).card_name + ' - Level ' + player.ItemLevel3"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId3).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId4 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId4).card_name + ' - Level ' + player.ItemLevel4"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId4).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId5 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId5).card_name + ' - Level ' + player.ItemLevel5"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId5).championCard_URL" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col row ml-2">
                                <div v-if="match.winning_task_force == 2" class="col-12 p-3 m-2 bg-success text-white text-center"><h3>WIN</h3></div>
                                <div v-else class="col-12 p-3 m-2 bg-danger text-white text-center"><h3>LOST</h3></div>
                                <div class="col-12 card border-0 d-flex flex-row" v-for="player in match.task_force_2" v-bind:key="player.playerId">
                                    <div class="row w-100">
                                        <div class="col-sm col-sm-auto pr-0">
                                            <img class="card-img-left mt-4" :src="getChampion(player.ChampionId).icon_url" height="65px"/>
                                        </div>
                                        <div class="col-sm px-0">
                                            <div class="card-body">
                                                <h4 class="card-title"><a :href="'/player/' + player.playerId" class="btn btn-outline-dark">{{ player.playerName }}</a> - {{ player.Reference_Name }}</h4>
                                                <p class="card-text">
                                                    <div class="row">
                                                        <div class="col-6 text-center">
                                                            <strong class="text-muted">K / D / A</strong> <br/>
                                                            <strong>{{ player.Kills_Player }} / {{ player.Deaths }} / {{ player.Assists }}</strong>
                                                        </div>

                                                        <div class="col-6 text-center">
                                                            <strong class="text-muted">CREDITS</strong> <br/>
                                                            <strong>{{ numberWithCommas(player.Gold_Earned) }}</strong>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <strong class="text-muted">LOADOUT</strong>
                                                        </div>

                                                        <div  v-if="player.ItemId6 > 0" class="col-3">
                                                            <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId6).card_name"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId6).championCard_URL" /></a>
                                                        </div>

                                                        <div class="col">
                                                            <div class="row">
                                                                <div v-if="player.ItemId1 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId1).card_name + ' - Level ' + player.ItemLevel1"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId1).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId2 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId2).card_name + ' - Level ' + player.ItemLevel2"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId2).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId3 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId3).card_name + ' - Level ' + player.ItemLevel3"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId3).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId4 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId4).card_name + ' - Level ' + player.ItemLevel4"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId4).championCard_URL" /></a>
                                                                </div>

                                                                <div v-if="player.ItemId5 > 0" class="col-4 mb-3">
                                                                    <a href="#" :title="getChampionCard(player.ChampionId, player.ItemId5).card_name + ' - Level ' + player.ItemLevel5"><img class="img-fluid rounded" :src="getChampionCard(player.ChampionId, player.ItemId5).championCard_URL" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
        </div>

        <div v-else>
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>

            <h4 class="text-center">We're getting all the matches from the archives.</h4>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['player'],

        data() {
            return {
                matches: [],
                champions: [],
            };
        },

        mounted() {
            this.getMatches();
        },

        methods: {
            getMatches() {
                axios.get('/api/player/' + this.$route.params.id + '/matches')
                    .then(r => {
                        this.matches = r.data.matches;
                        this.champions = r.data.champions;
                    });
            },

            getChampion(championId) {
                return this.champions.find(el => {
                    return championId == el.champion_id;
                });
            },

            getChampionCard(championId, cardId) {
                let champ = this.getChampion(championId);
                let cards = champ.cards;

                let card = cards.find(el => {
                    return (cardId == el.card_id1) || (cardId == el.card_id2);
                });

                return card != undefined ? card : {
                    card_name: "",
                    championCard_URL: "",
                };
            },

            numberWithCommas(numberToParse) {
                return numberToParse.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },

            secondsToMinutes(d) {
                d = Number(d);
                let m = Math.floor(d % 3600 / 60);
                let s = Math.floor(d % 3600 % 60);

                return m + ':' + this.rightPad(s.toString(), 2, '0');
            },

            rightPad(_string, _length, _char) {
                if (typeof _string !== 'string') {
                    throw new Error('The string parameter must be a string.');
                }
                if (typeof _length !== 'number') {
                    throw new Error('The length parameter must be a number.');
                }
                if(typeof _char !== 'string' && _char) {
                    throw new Error('The character parameter must be a string.');
                }

                var i = -1;
                _length = _length - _string.length;
                if (!_char && _char !== 0) {
                    _char = ' ';
                }
                while (++i < _length) {
                    _string += _char;
                }

                return _string;
                }
        }
    }
</script>
