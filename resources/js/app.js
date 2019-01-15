
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueEcho from 'vue-echo-laravel'
import Toasted from 'vue-toasted'
import Popover from 'vue-js-popover'

import StarRating from 'vue-star-rating'

import PlayerHomeView from './components/PlayerHome'
import PlayerMatchesView from './components/PlayerMatches'
import PlayerChampionsView from './components/PlayerChampions'
import PlayerFriendsView from './components/PlayerFriends'
import PlayerLoadoutsView from './components/PlayerLoadouts'
import PlayerReviewsView from './components/PlayerReviews'

import UserSettingsHomeView from './components/user/UserSettingsHome'
import UserSettingsPasswordView from './components/user/UserSettingsPassword'

import moment from 'moment-timezone'

moment.tz.setDefault('UTC')

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

const EchoInstance = window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
    namespace: 'PaladinsNinja.Events'
});


Vue.prototype.$moment = moment
Vue.prototype.$userAuthState = $('meta[name=login-status]').attr('content') === 'true';

Vue.use(VueRouter);
Vue.use(VueEcho, EchoInstance);
Vue.use(Toasted, { VueRouter });
Vue.use(Popover);

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('star-rating', StarRating);

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)));

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/player/:id',
            name: 'player.home',
            component: PlayerHomeView
        },
        {
            path: '/player/:id/matches',
            name: 'player.matches',
            component: PlayerMatchesView
        },
        {
            path: '/player/:id/champions',
            name: 'player.champions',
            component: PlayerChampionsView
        },
        {
            path: '/player/:id/friends',
            name: 'player.friends',
            component: PlayerFriendsView
        },
        {
            path: '/player/:id/loadouts',
            name: 'player.loadouts',
            component: PlayerLoadoutsView
        },
        {
            path: '/player/:id/reviews',
            name: 'player.reviews',
            component: PlayerReviewsView
        },

        // User Settings
        {
            path: '/settings',
            name: 'user.settings.home',
            component: UserSettingsHomeView
        },
        {
            path: '/settings/password',
            name: 'user.settings.password',
            component: UserSettingsPasswordView
        }
    ],
});

const app = new Vue({
    el: '#app',
    router
});

$(function () {
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
});