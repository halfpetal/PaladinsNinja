<template>
    <div>
        <div v-if="champions.length > 0" class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Champion Statistics</div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover" data-table="datatable" id="championRankingTable">
                            <thead>
                                <tr class="text-center">
                                    <th>Champion</th>
                                    <th>Level</th>
                                    <th>Matches</th>
                                    <th>K / D / A</th>
                                    <th>Total Credits</th>
                                    <th>Playtime</th>
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
                                    <td class="text-center align-middle"><span data-toggle="tooltip" data-placement="top" :title="'Total XP - ' + numberWithCommas(c.Worshippers)">{{ c.Rank }}</span></td>
                                    <td class="text-center align-middle">
                                        {{ numberWithCommas(c.Wins + c.Losses) }} ({{ numberWithCommas(c.Wins) }}W - {{ numberWithCommas(c.Losses) }}L)
                                        <br/>
                                        <span class="text-muted">{{ Math.max( Math.round((c.Wins / (c.Wins + c.Losses) * 100) * 10) / 10, 2.8 ).toFixed(2) }}% W/L</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ numberWithCommas(c.Kills) }} / {{ numberWithCommas(c.Deaths) }} / {{ numberWithCommas(c.Assists) }}
                                        <br/>
                                        <span class="text-muted">{{ ((c.Kills + (c.Assists / 2)) / c.Deaths).toFixed(2) }} RATIO</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ numberWithCommas(c.Gold) }}
                                        <br/>
                                        <span class="text-muted">~{{ Math.floor(c.Gold / c.Deaths) }} CPL</span>
                                    </td>
                                    <td class="text-center align-middle"><span data-toggle="tooltip" data-placement="top" :title="' Last Played - ' + c.LastPlayed">{{ minutesToHours(c.Minutes) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
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

            <h4 class="text-center">We're getting all the champions from the archives.</h4>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                championRanks: [],
                champions: [],
                dataTableOpts: {
                    paging: false,
                    order: [[ 1, "desc" ]]
                }
            };
        },

        mounted() {
            this.getChampionRanks();
        },

        methods: {
            getChampionRanks() {
                 axios.get('/api/player/' + this.$route.params.id + '/champions')
                    .then(r => {
                        this.championRanks = r.data.championRanks;
                        this.champions = r.data.champions;

                        this.$nextTick(function() {
                            window.$('#championRankingTable').DataTable(this.dataTableOpts);
                        });
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
