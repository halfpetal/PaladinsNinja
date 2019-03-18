<template>
    <div class="row">
        <h3 class="col-12">My Settings</h3>
        <div class="col-3 card mr-5 mt-3">
            <div class="card-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <h5>Account Management</h5>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'user.settings.password' }">
                            <i class="fas fa-key"></i> Password
                        </router-link>
                        <router-link class="nav-link" :to="{ name: 'user.settings.oauth' }">
                            <i class="fas fa-handshake"></i> Authorized OAuth Apps
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col card">
            <div class="card-body">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        //
    }
</script>