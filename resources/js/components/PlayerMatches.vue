<template>
    <div>
        <div v-if="matches.length > 0">
            <div v-for="m in this.matches" :key="m.Match" v-if="m.Map_Game.indexOf('Practice') < 0" class="card mb-3">
                <div class="card-header">
                    <span class="float-left">
                        <span :class="'badge badge-' + (m.Win_Status === 'Winner' ? 'success' : 'danger')">{{ m.Win_Status }}</span>
                        {{ m.Name }} ( {{ m.Map_Game.replace('LIVE ', '').replace('WIP ', '').replace('Ranked ', '').replace('Practice ', '') }} ) - {{ m.Region }}
                    </span>

                    <span class="float-right">
                        {{ secondsToMinutes(m.Time_In_Match_Seconds)  }} 
                    </span>
                </div>
                
                <div class="card-body">
                    <div class="row mx-3">
                        <div class="col-3">
                            <div class="row w-100 mb-3">
                                <div class="col-sm col-sm-auto pr-3">
                                    <img class="card-img-left" :src="getChampion(m.ChampionId).icon_url" height="65px"/>
                                </div>
                                <div class="col-sm px-0">
                                    <h4 class="card-title">{{ m.Reference_Name }}</h4>
                                </div>
                            </div>
                            <a :href="'/match/' + m.Match" class="btn btn-outline-primary btn-block">View Full Match Details</a>
                        </div>

                        <div class="col">
                            <p class="card-text">
                                <div class="row text-center">
                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Total Credits</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Gold_Earned) }} ({{ numberWithCommas(m.Gold_Per_Minute) }} CPM)</strong>
                                    </div>
                                    
                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Damage Taken</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Damage_Taken) }}</strong>
                                    </div>

                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Damage Done</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Damage_Player) }}</strong>
                                    </div>

                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Objective Time</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Objective_Assists) }}</strong>
                                    </div>

                                    
                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Shielding</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Damage_Mitigated) }}</strong>
                                    </div>

                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Healing</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Healing) }}</strong>
                                    </div>

                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Killing Streak</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Killing_Spree) }}</strong>
                                    </div>

                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Kills / Assists</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Kills_Player) }} / {{ numberWithCommas(m.Assists) }}</strong>
                                    </div>

                                    <div class="col-4 mb-3">
                                        <strong class="text-muted">Deaths</strong> <br/>
                                        <strong>{{ numberWithCommas(m.Deaths) }}</strong>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <strong class="text-muted">LOADOUT</strong>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div v-if="m.ItemId1 > 0" class="col mb-3">
                                                <a href="#" :title="getChampionCard(m.ChampionId, m.ItemId1).card_name + ' - Level ' + m.ItemLevel1"><img class="img-fluid rounded" :src="getChampionCard(m.ChampionId, m.ItemId1).championCard_URL" /></a>
                                            </div>

                                            <div v-if="m.ItemId2 > 0" class="col mb-3">
                                                <a href="#" :title="getChampionCard(m.ChampionId, m.ItemId2).card_name + ' - Level ' + m.ItemLevel2"><img class="img-fluid rounded" :src="getChampionCard(m.ChampionId, m.ItemId2).championCard_URL" /></a>
                                            </div>

                                            <div v-if="m.ItemId3 > 0" class="col mb-3">
                                                <a href="#" :title="getChampionCard(m.ChampionId, m.ItemId3).card_name + ' - Level ' + m.ItemLevel3"><img class="img-fluid rounded" :src="getChampionCard(m.ChampionId, m.ItemId3).championCard_URL" /></a>
                                            </div>

                                            <div v-if="m.ItemId4 > 0" class="col mb-3">
                                                <a href="#" :title="getChampionCard(m.ChampionId, m.ItemId4).card_name + ' - Level ' + m.ItemLevel4"><img class="img-fluid rounded" :src="getChampionCard(m.ChampionId, m.ItemId4).championCard_URL" /></a>
                                            </div>

                                            <div v-if="m.ItemId5 > 0" class="col mb-3">
                                                <a href="#" :title="getChampionCard(m.ChampionId, m.ItemId5).card_name + ' - Level ' + m.ItemLevel5"><img class="img-fluid rounded" :src="getChampionCard(m.ChampionId, m.ItemId5).championCard_URL" /></a>
                                            </div>

                                            <div v-if="m.ItemId6 > 0" class="col">
                                                <a href="#" :title="getChampionCard(m.ChampionId, m.ItemId6).card_name"><img class="img-fluid rounded" :src="getChampionCard(m.ChampionId, m.ItemId6).championCard_URL" /></a>
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
        data() {
            return {
                matches: [],
                champions: [],
                player: [],
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
                        this.player = r.data.player;
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
