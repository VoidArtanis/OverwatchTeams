/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');
Vue.config.devtools = true;
Vue.config.debug = true;
Vue.config.silent = true;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import example from './components/Example.vue';
Vue.component('example', example);

import herocards from './components/HeroCards.vue';
Vue.component('herocards', herocards);

import stats from './components/PlayerStats.vue';
Vue.component('playerstats', stats);

import teammmber from './components/TeamMember.vue';
Vue.component('teammember', teammmber);

const app = new Vue({
    el: '#app'
});