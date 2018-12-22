<template>
    <div>
        <div v-if="friends.length > 0">
            <div class="card">
                <div class="card-header">Friends List</div>
                
                <div class="card-text p-4 row align-items-center">
                    <div class="col m-2" v-if="friends.length > 0" v-for="friend in friends" :key="friend.player_id">
                        <span><a :href="'/player/' + friend.player_id" class="btn btn-outline-dark btn-lg">{{ friend.name }}</a></span>
                    </div>

                    <h4 v-else>Account has no friends. Note: Console player friends list are not given to us.</h4>
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

            <h4 class="text-center">We're getting all the friends from the archives.</h4>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                friends: []
            };
        },

        mounted() {
            this.getFriends();
        },

        methods: {
            getFriends() {
                axios.get('/api/player/' + this.$route.params.id + '/friends')
                    .then(r => {
                        this.friends = r.data;
                    });
            }
        }
    }
</script>
