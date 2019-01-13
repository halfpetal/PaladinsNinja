<template>
    <div>
        <h2>Change Password</h2>
        <hr>
        <div class="alert alert-danger" v-if="passwordForm.errors.length > 0">
            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
            <br>
            <ul>
                <li v-for="error in passwordForm.errors">
                    {{ error }}
                </li>
            </ul>
        </div>
        <form role="form" @submit.prevent="store">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" class="form-control" placeholder="Current Password" v-model="passwordForm.current_password">
            </div>

            <div class="form-group" v-if="passwordForm.current_password.length > 0">
                <label>New Password</label>
                <input type="password" class="form-control" placeholder="New Password" v-model="passwordForm.new_password">
            </div>

            <div class="form-group" v-if="passwordForm.new_password.length > 0">
                <label>Confirm New Password</label>
                <input type="password" class="form-control" placeholder="Confirm New Password" v-model="passwordForm.new_password_confirmation">
            </div>

            <button type="button" class="btn btn-primary" v-if="passwordForm.new_password_confirmation.length > 0" @click="store">
                Change Password
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                passwordForm: {
                    errors: [],
                    current_password: '',
                    new_password: '',
                    new_password_confirmation: '',
                }
            }
        },

        methods: {
            store() {
                axios.post('/api-user/v1/settings/new-password', this.passwordForm)
                    .then(r => {
                        if (r.data.errors) {
                            this.passwordForm.errors = r.data.errors;
                            return;
                        }

                        this.passwordForm.errors = [];
                        this.passwordForm.current_password = '';
                        this.passwordForm.new_password = '';
                        this.passwordForm.new_password_confirmation = '';

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
                            this.passwordForm.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            this.passwordForm.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            }
        }
    }
</script>