<template>
    <div>
        <div v-if="newsItems.length > 0" class="row">
            <div v-for="item in newsItems" :key="item.id" class="col-6 card">
                <div class="card-body">
                    <h5 class="card-title">{{ review.title }}</h5>
                    <hr>
                    <blockquote class="blockquote card-text">
                        <p class="mb-0">
                            {{ review.body }}
                        </p>
                        <footer class="blockquote-footer">
                            {{ review.user.username }} | {{ review.rating }} <i class="fas fa-star"></i> | <a :href="`/match/${review.match_id}`">View Match Details</a>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>

        <h4 v-else>No news items, or could not retrieve them.</h4>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newsItems: [],
        }
    },

    mounted() {
        this.getNewsItems();
    },

    methods: {
        getNewsItems() {
            this.$http.get('https://cms.paladins.com/wp-json/api/get-posts/1')
                .then(r => {
                    this.newsItems = r.body;
                });
        }
    }
}
</script>
