<template>
    <div>
        <h4 v-if="ranked.tier_controller == null && ranked.tier_kbm == null">Player profile has not been migrated to cross-play update. Please request an update.</h4>
        <div v-else>
            <div class="row pb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">Ranked Keyboard & Mouse <span class="text-muted">Season {{ ranked.ranked_kbm['Season'] - 1 }}</span></div>
                            
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-start">
                                <img :src="'/images/ranked/' + ranked.tier_kbm + '.png'" class="mr-2">
                                <div class="text-left">
                                    <h3>{{ ranked_tier_display(ranked.tier_kbm) }}</h3>
                                    <div class="d-flex justify-content-around">
                                        <p class="pr-3 text-center">
                                            <strong class="text-muted">Current TP</strong> <br/>
                                            <strong>{{ ranked.ranked_kbm['Points'] }}</strong>
                                        </p>

                                        <p class="text-center">
                                            <strong class="text-muted">Wins / Losses</strong> <br/>
                                            <strong>{{ ranked.ranked_kbm['Wins'] }}W / {{ ranked.ranked_kbm['Losses'] }}L</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">Ranked Controller <span v-if="ranked.ranked_controller['Season'] > 0" class="text-muted">Season {{ ranked.ranked_controller['Season'] }}</span></div>
                            
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-start">
                                <img :src="'/images/ranked/' + ranked.tier_controller + '.png'" class="mr-2">
                                <div class="text-left">
                                    <h3>{{ ranked_tier_display(ranked.tier_controller) }}</h3>
                                    <div class="d-flex justify-content-around">
                                        <p class="pr-3 text-center">
                                            <strong class="text-muted">Current TP</strong> <br/>
                                            <strong>{{ ranked.ranked_controller['Points'] }}</strong>
                                        </p>

                                        <p class="text-center">
                                            <strong class="text-muted">Wins / Losses</strong> <br/>
                                            <strong>{{ ranked.ranked_controller['Wins'] }}W / {{ ranked.ranked_controller['Losses'] }}L</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div v-if="matches != undefined && matches.data.length > 0">
                    <div v-for="m in matches.data" :key="m.Match" class="card mb-3">
                        <div class="card-header">
                            <span class="float-left">
                                <span :class="'badge badge-' + (m.Win_Status === 'Winner' ? 'success' : 'danger')">{{ m.Win_Status }}</span>
                                {{ m.name }} ( {{ m.Map_Game.replace('LIVE ', '').replace('WIP ', '').replace('Ranked ', '').replace('Practice ', '') }} ) - {{ m.Region }}
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

            <pagination class="mt-4" :show-disabled="true" :data="matches" @pagination-change-page="getRankedMatches"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ranked: [],
                matches: {},
            };
        },

        mounted() {
            this.getRanked();
            this.getRankedMatches();
        },

        methods: {
            getRanked() {
                axios.get(`/api-player/v1/${this.$route.params.id}/ranked`)
                    .then(r => {
                        this.ranked = r.data;
                    });
            },

            getRankedMatches(page = 1) {
                axios.get(`/api-player/v1/${this.$route.params.id}/ranked/matches?page=${page}`)
                    .then(r => {
                        this.matches = r.data;
                    });
            },

            getChampion(championId) {
                return this.$parent.champions.find(el => {
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
