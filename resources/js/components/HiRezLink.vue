<template>
    <div>
        <div class="card">
            <div class="card-header">Hi-Rez Account Login</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="loginForm.errors.length > 0">
                    <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                    <br>
                    <ul>
                        <li v-for="error in loginForm.errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <form role="form" @submit.prevent="store">
                    <div class="form-group">
                        <label for="usernameInput">Hi-Rez Username</label>
                        <input type="text" class="form-control" id="usernameInput" placeholder="Enter username" v-model="loginForm.username">
                    </div>

                    <div class="form-group">
                        <label for="passwordInput">Hi-Rez Password</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="Enter password" v-model="loginForm.password">
                    </div>

                    <button type="button" class="btn btn-primary" @click="store">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loginForm: {
                    username: '',
                    password: '',
                    code: '',
                    errors: [],
                }
            }
        },

        mounted() {
        },

        methods: {
            store() {
                this.loginForm.errors = [];

                axios.post('/api-user/v1/hirez-link', this.loginForm)
                    .then(r => {
                        if (r.data.errors && r.data.errors.length >= 1) {
                            this.loginForm.errors = _.flatten(_.toArray(r.data.errors));
                        }

                        if (r.data.need2fa) {
                            this.loginForm.errors = [
                                'Please disable 2FA on your account during this process. You can re-enable it immediately after.'
                            ];
                        }

                        if (r.data.connected) {
                            window.location.href = '/';
                        }
                    });
            }
        }
    }
</script>

