<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
            <a class="navbar-brand" href="#">{{ playername }}</a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.home' }">Home</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.ranked' }">Ranked</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.champions' }">Champions</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.loadouts' }">Champion Loadouts</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.matches' }">Recent Matches</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.friends' }">Friends</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.queue' }">Queue Stats</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'player.reviews' }">Community Reviews</router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['playername', 'playerid'],

        data() {
            return {
                champions: [],
            }
        },

        mounted() {
            this.getChampions();
        },

        methods: {
            getChampions() {
                axios.get('/api-champion/v1/list?nopaginate=true')
                    .then(r => {
                        this.champions = r.data;
                    });
            },

            getChampionById(championId) {
                return this.champions.filter(el => {
                    return el.champion_id == championId;
                });
            }
        }
    }
</script>

