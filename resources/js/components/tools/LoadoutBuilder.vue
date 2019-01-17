<template>
    <div>
        <div v-if="step == 1" class="row">
            <p class="col-4">
                Howdy! <br/>

                Welcome to the Paladins Ninja Loadout Builder. Usage of this builder is pretty simple.

                <ol>
                    <li>Choose a champion.</li>
                    <li>Come up with a name and tell us about it.</li>
                    <li>Create the loadout</li>
                </ol>
            </p>

            <div class="col">
                <div class="card">
                    <div class="card-header">Champion Select</div>

                    <div class="card-body">
                        <select class="form-control" v-model="selectedChampion">
                            <option disabled selected="" value="">Choose a champion...</option>
                            <option v-for="c in champions" :key="c.champion_id" :value="c.champion_id">
                                {{ c.name }}
                            </option>
                        </select>
                    </div>

                    <div class="card-footer text-muted">
                        <button @click="goToStep2()" class="btn btn-primary float-right">Continue...</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="step == 2" class="row">
            <p class="col-4">
                Howdy! <br/>

                Welcome to the Paladins Ninja Loadout Builder. Usage of this builder is pretty simple.

                <ol>
                    <li>Choose a champion.</li>
                    <li>Come up with a name and tell us about it.</li>
                    <li>Create the loadout</li>
                </ol>
            </p>

            <div class="col">
                <div class="card">
                    <div class="card-header">Loadout Info</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="loadoutNameInput">Loadout Name</label>
                            <input type="text" class="form-control" id="loadoutNameInput" placeholder="My Awesome Loadout" v-model="buildName">
                        </div>

                        <div class="form-group">
                            <label for="loadoutDescriptionInput">Quick Description</label>
                            <textarea class="form-control" id="loadoutDescriptionInput" rows="3" v-model="buildDescription"></textarea>
                        </div>
                    </div>

                    <div class="card-footer text-muted">
                        <button @click="goToStep3()" class="btn btn-primary float-right">Continue...</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="step == 3">
            <div class="row">
                <h5 class="text-muted col">
                    Now it's time for the actual building of the loadouts. It's similar to the in-game loadout builder, so you should know what's happening. Once you're done, just hit that "Create Loadout" button and we'll take care of the rest.
                </h5>

                <div class="col-3">
                    <button class="btn btn-success float-right">Create Loadout</button>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 mb-4">
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" :style="'width:' + currentPoints * 6.666667 + '%'" :aria-valuenow="currentPoints" aria-valuemin="5" aria-valuemax="15">{{ currentPoints }} / 15</div>
                    </div>
                </div>

                <div v-for="index in 5" :key="index" class="col">
                    <div class="card">
                        <div v-if="card[index].id > 0">
                            <img :src="getCardById(card[index].id)[0].championCard_URL" class="card-img-top">
                            <div class="card-body">
                                <div class="card-text">
                                    <h4>{{ getCardById(card[index].id)[0].card_name }}</h4>
                                    <div class="pb-2 w-100">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-primary" @click="changePoint(index, -1)">-</button>
                                            <button type="button" disabled class="btn btn-outline-dark">{{ card[index].points }}</button>
                                            <button type="button" class="btn btn-outline-primary" @click="changePoint(index, 1)">+</button>
                                        </div>
                                    </div>

                                    <p>
                                        {{ getCardById(card[index].id)[0].card_description }}
                                    </p>
                                </div>
                                <button type="button" class="btn btn-primary btn-block" @click="setCurrentCardSlot(index)">
                                    Change card
                                </button>
                            </div>
                        </div>

                        <div v-else>
                            <img src="https://via.placeholder.com/256x196?text=Paladins+Ninja+Loadout+Builder" class="card-img-top">
                            <div class="card-body">
                                <p class="card-text">
                                    This is just a placeholder. Please add a card to fill in this card.
                                </p>
                                <button type="button" class="btn btn-primary btn-block" @click="setCurrentCardSlot(index)">
                                    Add a card
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="availableCardModal" tabindex="-1" role="dialog" aria-labelledby="availableCardModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="availableCardModalCenterTitle">Available Cards</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div v-for="c in availableCards" :key="c.card_id2" v-if="c.rarity != 'Legendary'" class="col-3 mb-4">
                                    <img :src="c.championCard_URL" class="img-fluid rounded mb-3" data-toggle="tooltip" :title="c.card_description">
                                    <h4>{{ c.card_name }}</h4>
                                    <button type="button" class="btn btn-primary btn-sm" @click="selectCard(c.card_id2)">Add Card</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NumberInputSpinner from 'vue-number-input-spinner'

    export default {
        components: {
            NumberInputSpinner,
        },

        data() {
            return {
                step: 1,
                champions: [],
                availableCards: [],
                allCards: [],
                champion: [],
                selectedChampion: 0,
                buildName: '',
                buildDescription: null,
                currentCardSlot: 0,
                currentPoints: 5,
                card: {
                    1: {
                        id: 0,
                        points: 1
                    },

                    2: {
                        id: 0,
                        points: 1
                    },

                    3: {
                        id: 0,
                        points: 1
                    },

                    4: {
                        id: 0,
                        points: 1
                    },

                    5: {
                        id: 0,
                        points: 1
                    },
                }
            };
        },

        mounted() {
            this.getChampions();
        },
        methods: {
            sortAlpha(property) {
                return function(a, b) {
                    return a[property].localeCompare(b[property]);
                };
            },

            changePoint(cardIndex, change) {
                if (change <= 0 && this.card[cardIndex].points <= 1) {
                    return;
                }

                if (change >= 0 && this.card[cardIndex].points >= 5) {
                    return;
                }

                if (change >= 0 && this.currentPoints >= 15) {
                    return;
                }

                this.currentPoints += change;
                this.card[cardIndex].points += change;
            },

            getChampions() {
                axios.get('/api-champion/v1/list?nopaginate=true')
                    .then(r => {
                        this.champions = r.data;
                    });
            },

            getCardById(cardId) {
                return this.allCards.filter((el) => {
                    return (cardId == el.card_id2) || (cardId == el.card_id1);
                });
            },

            addCardById(cardId) {
                let card = this.getCardById(cardId)[0];

                if (card != undefined) {
                    this.availableCards.push(card);
                    this.availableCards.sort(this.sortAlpha('card_name'));
                }
            },

            removeCardById(cardId) {
                this.availableCards = this.availableCards.filter((el) => {
                    return (cardId != el.card_id2) && (cardId != el.card_id1);
                });
            },

            selectCard(cardId) {
                if (this.currentCardSlot <= 0) {
                    this.showToast('Card slot id is invalid, please try again.');
                    return;
                }

                let selectedCard = this.getCardById(cardId);

                if (selectedCard == null || selectedCard == undefined) {
                    this.showToast('Card id is invalid, please try again.');
                    return;
                }

                if (this.card[this.currentCardSlot].id > 0) {
                    this.addCardById(this.card[this.currentCardSlot].id);
                }

                this.card[this.currentCardSlot].id = cardId;
                this.removeCardById(cardId);
                $('#availableCardModal').modal('hide');
            },

            setCurrentCardSlot(cardSlotId) {
                $('#availableCardModal').modal('show');
                this.currentCardSlot = cardSlotId;
            },

            goToStep2() {
                if (this.selectedChampion <= 0) {
                    this.showToast('You must select a champion!');
                    return;
                }

                let champ = this.champions.filter((el) => {
                    return this.selectedChampion == el.champion_id;
                })

                if (champ == undefined || champ == null) {
                    this.showToast('Somethig went wrong. Please try again.');
                    return;
                }

                this.champion = champ[0];
                this.availableCards = this.champion.cards;
                this.allCards = this.champion.cards;

                this.step++;
            },

            goToStep3() {
                if (this.buildName == null || this.buildName.length <= 0) {
                    this.showToast('You must have a loadout name.');
                    return;
                }

                if (this.buildName < 5) {
                    this.showToast('The loadout name must be 5 characters or more.');
                    return;
                }

                if (this.buildName.length > 32) {
                    this.showToast('Whoa there cowboy. The loadout name has to be less than 32 characters.');
                    return;
                }

                if (this.buildDescription == null || this.buildDescription.length <= 0) {
                    this.buildDescription = null;
                }

                if (this.buildDescription != null && this.buildDescription.length > 255) {
                    this.showToast('Do you really need more than 255 characters for a description?');
                    return;
                }

                this.step++;
            },

            showToast(message) {
                this.$toasted.show(message, {
                    position: 'bottom-right',
                    duration: 5000,
                    closeOnSwipe: true,
                    action : {
                        text : 'Close',
                        onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                        }
                    },
                });
            }
        }
    }
</script>
