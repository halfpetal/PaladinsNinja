<template>
    <div>
        <div v-if="newsItems.length > 0"></div>
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
