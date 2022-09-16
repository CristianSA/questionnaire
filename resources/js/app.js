/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import vuetify from './vuetify';

import route from 'ziggy';
import { Ziggy } from './ziggy';

Vue.use(Ziggy);

//ADMIN
// PROJECTS
Vue.component('projects', require('./components/projects/Index.vue').default);
Vue.component('form-project', require('./components/projects/Form.vue').default);
Vue.component('show-project', require('./components/projects/Show.vue').default);
Vue.component('show-analytic-project', require('./components/projects/analytics/ByProject.vue').default);
// PROJECTS IMAGES
Vue.component('index-images', require('./components/images/Index.vue').default);
Vue.component('form-images', require('./components/images/Form.vue').default);
// MODULES
Vue.component('modules', require('./components/modules/Modules.vue').default);
Vue.component('form-new-module', require('./components/modules/forms/New.vue').default);

//STUDENT
// PROJECTS
Vue.component('student-projects', require('./components/students/projects/Index.vue').default);
// MODULES
Vue.component('student-modules', require('./components/students/projects/modules/Index.vue').default);
Vue.component('student-module', require('./components/students/projects/modules/Module.vue').default);
// QUESTIONS
Vue.component('student-questions', require('./components/students/projects/modules/questions/Questions.vue').default);
// RESULTS
Vue.component('student-result', require('./components/students/projects/modules/questions/Result.vue').default);
// MY RESULTS
Vue.component('student-results', require('./components/students/results/Results.vue').default);
Vue.component('project-list', require('./components/students/projects/Projects.vue').default);
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify,
    route,
});
