require('./bootstrap');

window.Vue = require('vue');

//register
Vue.component('register', require('./components/Account/RegisterComponent.vue').default);

//login
Vue.component('login', require('./components/Account/LoginComponent.vue').default);

//logged in header
Vue.component('loggedin-header', require('./components/Loggedin/Header/LoggedinHeaderComponent.vue').default);

//create a debate
Vue.component('questions', require('./components/Loggedin/CreateADebate/QuestionViewComponent.vue').default);

//search
Vue.component('search', require('./components/Loggedin/Search/SearchComponent.vue').default);

//profile
Vue.component('profile', require('./components/Loggedin/Profile/ProfileViewComponent.vue').default);

//notifications
Vue.component('notifications', require('./components/Loggedin/Notification/NotificationsView.vue').default);

import store from './store/index';
const app = new Vue({
	store,
    el: '#app',
});