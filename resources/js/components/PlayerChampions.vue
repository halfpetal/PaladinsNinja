<template>
    <div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Champion Statistics</div>

                    <div class="card-body">
                        <table class="table table-hover" id="championRankingTable">
                            <thead>
                                <tr class="text-center">
                                    <th>Champion</th>
                                    <th>Level</th>
                                    <th>Matches</th>
                                    <th>W / L Ratio</th>
                                    <th>K / D / A</th>
                                    <th>Total Credits</th>
                                    <th>Playtime</th>
                                    <th>Last Played</th>
                                    <th>Total XP Earned</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="c in championRanks" v-bind:key="c.champion_id" class="align-middle">
                                    <td>
                                        <div class="row">
                                            <div class="col-sm col-sm-auto pr-0">
                                                <img class="card-img-left align-middle" :src="getChampion(c.champion_id).icon_url" height="65px"/>
                                            </div>
                                            <div class="col-sm px-0">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <strong>{{ c.champion }}</strong> <br/>
                                                        <span class="text-muted">{{ getChampion(c.champion_id).role }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">{{ c.Rank }}</td>
                                    <td class="text-center align-middle">{{ numberWithCommas(c.Wins + c.Losses) }} ({{ numberWithCommas(c.Wins) }}W - {{ numberWithCommas(c.Losses) }}L)</td>
                                    <td class="text-center align-middle">{{ Math.max( Math.round((c.Wins / (c.Wins + c.Losses) * 100) * 10) / 10, 2.8 ).toFixed(2) }}%</td>
                                    <td class="text-center align-middle">
                                        {{ numberWithCommas(c.Kills) }} / {{ numberWithCommas(c.Deaths) }} / {{ numberWithCommas(c.Assists) }}
                                        <br/>
                                        <span class="text-muted">{{ ((c.Kills + (c.Assists / 2)) / c.Deaths).toFixed(2) }} RATIO</span>
                                    </td>
                                    <td class="text-center align-middle">{{ numberWithCommas(c.Gold) }} (~{{ Math.floor(c.Gold / c.Deaths) }} CPL)</td>
                                    <td class="text-center align-middle">{{ minutesToHours(c.Minutes) }}</td>
                                    <td class="text-center align-middle">{{  c.LastPlayed | moment('from', 'now') }}</td>
                                    <td class="text-center align-middle">{{ numberWithCommas(c.Worshippers) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['player'],

        data() {
            return {
                championRanks: [],
                champions: [],
            };
        },

        mounted() {
            this.getChampionRanks();
        },

        methods: {
            getChampionRanks() {
                 axios.get('/api/player/' + this.player + '/champions')
                    .then(r => {
                        this.championRanks = r.data.championRanks;
                        this.champions = r.data.champions;
                    });
            },

            getChampion(championId) {
                return this.champions.find(el => {
                    return championId == el.champion_id;
                });
            },

            numberWithCommas(numberToParse) {
                return numberToParse.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },

            minutesToHours(mins) {
                let h = Math.floor(mins / 60);
                let m = mins % 60;
                h = h < 10 ? '0' + h : h;
                m = m < 10 ? '0' + m : m;
                return `${h}H ${m}M`;
            },
        },
    }
</script>
