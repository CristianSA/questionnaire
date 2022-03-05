/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import vuetify from './vuetify';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//ADMIN
// PROJECTS
Vue.component('projects', require('./components/projects/Projects.vue').default);
Vue.component('form-new-project', require('./components/projects/forms/New.vue').default);
Vue.component('show-project', require('./components/projects/Show.vue').default);

//STUDENT
// PROJECTS
Vue.component('student-projects', require('./components/students/projects/Projects.vue').default);
// MODULES
Vue.component('student-modules', require('./components/students/projects/modules/Modules.vue').default);
Vue.component('student-module', require('./components/students/projects/modules/Module.vue').default);
// QUESTIONS
Vue.component('student-questions', require('./components/students/projects/modules/questions/Questions.vue').default);
// RESULTS
Vue.component('student-results', require('./components/students/projects/modules/questions/Results.vue').default);
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify
});
