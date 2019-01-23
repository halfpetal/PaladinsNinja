<template>
    <div>
        <div class="alert alert-danger" v-if="tierForm.errors.length > 0">
            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
            <br>
            <ul>
                <li v-for="error in tierForm.errors">
                    {{ error }}
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tierlistName">Name</label>
                            <input v-model="tierForm.name" type="text" class="form-control" id="tierlistName" placeholder="My Awesome Tierlist">
                        </div>

                        <div class="form-group">
                            <label for="tierlistDescription">Description (optional)</label>
                            <textarea v-model="tierForm.description" class="form-control" id="tierlistDescription" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-2 border-right">
                                    <h1>SS</h1>
                                </div>
                                <div class="col">
                                    <div class="card-body p-0">
                                        <draggable class="row" v-model="tierForm.tier_ss" :options="{group:'champions'}" @start="drag=true" @end="drag=false">
                                            <div class="col-2" v-for="champion in tierForm.tier_ss" :key="champion.champion_id">
                                                <div class="card" style="width:75px;height:75px;">
                                                    <img :src="champion.icon_url" class="card-img-top">
                                                    <div class="champion-image-content w-100 text-center text-white">{{ champion.name }}</div>
                                                </div>
                                            </div>
                                        </draggable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-2 border-right">
                                    <h1>S</h1>
                                </div>
                                <div class="col">
                                    <div class="card-body p-0">
                                        <draggable class="row" v-model="tierForm.tier_s" :options="{group:'champions'}" @start="drag=true" @end="drag=false">
                                            <div class="col-2" v-for="champion in tierForm.tier_s" :key="champion.champion_id">
                                                <div class="card" style="width:75px;height:75px;">
                                                    <img :src="champion.icon_url" class="card-img-top">
                                                    <div class="champion-image-content w-100 text-center text-white">{{ champion.name }}</div>
                                                </div>
                                            </div>
                                        </draggable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-2 border-right">
                                    <h1>A</h1>
                                </div>
                                <div class="col">
                                    <div class="card-body p-0">
                                        <draggable class="row" v-model="tierForm.tier_a" :options="{group:'champions'}" @start="drag=true" @end="drag=false">
                                            <div class="col-2" v-for="champion in tierForm.tier_a" :key="champion.champion_id">
                                                <div class="card" style="width:75px;height:75px;">
                                                    <img :src="champion.icon_url" class="card-img-top">
                                                    <div class="champion-image-content w-100 text-center text-white">{{ champion.name }}</div>
                                                </div>
                                            </div>
                                        </draggable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-2 border-right">
                                    <h1>B</h1>
                                </div>
                                <div class="col">
                                    <div class="card-body p-0">
                                        <draggable class="row" v-model="tierForm.tier_b" :options="{group:'champions'}" @start="drag=true" @end="drag=false">
                                            <div class="col-2" v-for="champion in tierForm.tier_b" :key="champion.champion_id">
                                                <div class="card" style="width:75px;height:75px;">
                                                    <img :src="champion.icon_url" class="card-img-top">
                                                    <div class="champion-image-content w-100 text-center text-white">{{ champion.name }}</div>
                                                </div>
                                            </div>
                                        </draggable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-2 border-right">
                                    <h1>C</h1>
                                </div>
                                <div class="col">
                                    <div class="card-body p-0">
                                        <draggable class="row" v-model="tierForm.tier_c" :options="{group:'champions'}" @start="drag=true" @end="drag=false">
                                            <div class="col-2" v-for="champion in tierForm.tier_c" :key="champion.champion_id">
                                                <div class="card" style="width:75px;height:75px;">
                                                    <img :src="champion.icon_url" class="card-img-top">
                                                    <div class="champion-image-content w-100 text-center text-white">{{ champion.name }}</div>
                                                </div>
                                            </div>
                                        </draggable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-2 border-right">
                                    <h1>D</h1>
                                </div>
                                <div class="col">
                                    <div class="card-body p-0">
                                        <draggable class="row" v-model="tierForm.tier_d" :options="{group:'champions'}" @start="drag=true" @end="drag=false">
                                            <div class="col-2" v-for="champion in tierForm.tier_d" :key="champion.champion_id">
                                                <div class="card" style="width:75px;height:75px;">
                                                    <img :src="champion.icon_url" class="card-img-top">
                                                    <div class="champion-image-content w-100 text-center text-white">{{ champion.name }}</div>
                                                </div>
                                            </div>
                                        </draggable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <button @click="store" class="btn btn-outline-primary btn-block mb-3">Create Tierlist</button>
                <div class="card">
                    <div class="card-header">
                        Available Champions
                    </div>

                    <div class="card-body">
                        <button class="btn btn-outline-secondary btn-block mb-4" @click="resetTiers">Reset Tiers</button>
                        <draggable class="card-columns" v-model="tierForm.champions" :options="{group:'champions'}" @start="drag=true" @end="drag=false">
                            <div v-for="champion in tierForm.champions" :key="champion.champion_id">
                                <div class="card" style="width:75px;height:75px;">
                                    <img :src="champion.icon_url" class="card-img-top">
                                    <div class="champion-image-content w-100 text-center text-white">{{ champion.name }}</div>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    
    export default {
        components: {
            draggable,
        },

        data() {
            return {
                tierForm: {
                    errors: [],
                    champions: [],
                    name: '',
                    description: null,
                    tier_ss: [],
                    tier_s: [],
                    tier_a: [],
                    tier_b: [],
                    tier_c: [],
                    tier_d: [],
                }
            }
        },

        mounted() {
            this.getChampions();
        },

        methods: {
            getChampions() {
                axios.get('/api-champion/v1/list?nopaginate=true')
                    .then(r => {
                        this.tierForm.champions = r.data;
                    });
            },

            store() {
                this.tierForm.errors = [];

                axios.post('/api-tool/v1/tierlist', this.tierForm)
                    .then(r => {
                        if (r.data.errors) {
                            this.tierForm.errors = r.data.errors;
                            return;
                        }

                        console.log(r.data);

                        this.showToast('Tierlist has been created. Redirecting to the tierlist page now.');

                        window.location.replace(`/tierlist/${r.data.id}`);
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            this.tierForm.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            this.tierForm.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            resetTiers() {
                this.tierForm.tier_ss = [];
                this.tierForm.tier_s = [];
                this.tierForm.tier_a = [];
                this.tierForm.tier_b = [];
                this.tierForm.tier_c = [];
                this.tierForm.tier_d = [];

                this.getChampions();

                this.$toasted.show('Tiers have been reset.', {
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
            }
        }
    }
</script>

<style>
.champion-image-content {
    background: none repeat scroll 0 0 #000000;
    opacity: 0.65;
    bottom:0;
    position: absolute;
}
</style>
