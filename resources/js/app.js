
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

import PlayerHomeView from './components/PlayerHome'
import PlayerMatchesView from './components/PlayerMatches'
import PlayerChampionsView from './components/PlayerChampions'

import moment from 'moment-timezone'

moment.tz.setDefault('UTC')

Vue.prototype.$moment = moment

Vue.use(VueRouter);

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
        }
    ],
});

const app = new Vue({
    el: '#app',
    router
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});