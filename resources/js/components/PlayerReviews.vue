<template>
    <div>
        <div v-if="this.$userAuthState" class="mb-4">
            <button v-if="!creatingReview" class="btn btn-outline-primary" @click="toggleCreatingReview">Make Review</button>

            <div v-if="creatingReview" class="card w-100 card-body">
                <div class="alert alert-danger" v-if="reviewForm.errors.length > 0">
                    <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                    <br>
                    <ul>
                        <li v-for="error in reviewForm.errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>
                <form>
                    <div class="form-group">
                        <label>Match ID</label>
                        <input type="text" class="form-control" placeholder="1234567890" v-model="reviewForm.match_id">
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="An Awesome Review Title" v-model="reviewForm.title">
                    </div>

                    <div class="form-group">
                        <label>Tell Us About It</label>
                        <textarea class="form-control" rows="3" v-model="reviewForm.body"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Rating</label>
                        <star-rating v-model="reviewForm.rating" :increment="0.5" :star-size="25"></star-rating>
                    </div>
                </form>

                <div class="form-group">
                    <button class="btn btn-outline-secondary" @click="toggleCreatingReview">Save for Later</button> <button class="btn btn-outline-primary" @click="storeReview">Submit</button>
                </div>
            </div>
            <hr>
        </div>

        <div class="card-columns">
            <div class="card" v-for="review in reviews.data" :key="review.id">
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
        <pagination :data="reviews" @pagiation-change-page="getReviews"></pagination>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                reviews: {},
                creatingReview: false,
                reviewForm: {
                    errors: [],
                    title: '',
                    body: '',
                    rating: 2.5,
                    match_id: null,
                }
            }
        },

        mounted() {
            this.getReviews();
        },

        methods: {
            getReviews(page = 1) {
                axios.get(`/api-player/v1/${this.$route.params.id}/review?page=${page}`)
                    .then(r => {
                        this.reviews = r.data;
                    });
            },

            toggleCreatingReview() {
                this.creatingReview = !this.creatingReview;
            },

            storeReview() {
                axios.post(`/api-player/v1/${this.$route.params.id}/review`, this.reviewForm)
                    .then(r => {
                        if (r.data.errors) {
                            this.reviewForm.errors = r.data.errors;
                            return;
                        }

                        // this.creatingReview = false;
                        // this.reviewForm.errors = [];
                        // this.reviewForm.match_id = null;
                        // this.reviewForm.rating = 2.5;
                        // this.reviewForm.title = '';
                        // this.reviewForm.body = '';

                        this.getReviews();

                        this.$toasted.show(r.data.message, {
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
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            this.reviewForm.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            this.reviewForm.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },
        },
    }
</script>
