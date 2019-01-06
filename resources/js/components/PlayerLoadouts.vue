<template>
    <div>
        <div v-if="loadouts.length > 0">
            <div class="card">
                <div class="card-header">Champion Loadouts</div>

                <div class="card-body table-responsive">
                    <table class="table table-hover" data-table="datatable" id="loadoutTable">
                        <thead>
                            <tr>
                                <th>Champion</th>
                                <th>Loadouts</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="champion in this.$parent.champions" :key="champion.champion_id">
                                <td class="w-25" :data-order="champion.name">
                                    <div class="row">
                                        <div class="col-sm col-sm-auto pr-0">
                                            <img class="card-img-left align-middle" :src="champion.icon_url" height="65px"/>
                                        </div>
                                        <div class="col-sm px-0">
                                            <div class="card-body">
                                                <p class="card-text">
                                                    <strong>{{ champion.name }}</strong> <br/>
                                                    <span class="text-muted">{{ champion.role }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div v-for="deck in getLoadoutsForChampion(champion.champion_id)" :key="deck.DeckId" class="btn-group mt-3" role="group">
                                        <button role="button" class="btn btn-outline-primary mr-4" data-toggle="modal" :data-target="'#deck-' + deck.DeckId + '-modal'">{{ deck.DeckName }}</button>

                                        <div class="modal fade" :id="'deck-' + deck.DeckId + '-modal'" tabindex="-1" role="dialog" :aria-labelledby="'deck-' + deck.DeckId + '-modalLabel'" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" :id="'deck-' + deck.DeckId + '-modalLabel'">{{ deck.DeckName }}</h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div v-for="item in deck.LoadoutItems" :key="item.ItemId" class="col">
                                                            <img class="img-fluid rounded mb-3" v-if="getCardById(champion.cards, item.ItemId).length" :src="getCardById(champion.cards, item.ItemId)[0].championCard_URL">
                                                            <h4 class="text-muted">{{ item.ItemName}}</h4>
                                                            <h5 class="text-muted">Level {{ item.Points }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

            <h4 class="text-center">We're getting all the champion loadouts from the archives.</h4>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loadouts: [],
                dataTableOpts: {
                    paging: false,
                }
            };
        },

        mounted() {
            this.getLoadouts();
        },

        methods: {
            getLoadouts() {
                axios.get('/api-player/v1/' + this.$route.params.id + '/loadouts')
                    .then(r => {
                        this.loadouts = r.data;
                    });
            },

            getLoadoutsForChampion(championId) {
                return this.loadouts.filter((el) => {
                    return championId == el.ChampionId;
                });
            },

            getCardById(cards, cardId) {
                return cards.filter((el) => {
                    return (cardId == el.card_id2) || (cardId == el.card_id1);
                });
            }
        }
    }
</script>
