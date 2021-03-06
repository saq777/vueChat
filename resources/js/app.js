/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import Vue from 'vue'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('messenger-component', require('./components/messenger/MessengerComponent.vue').default);
Vue.component('chat-component', require('./components/messenger/Chat.vue').default);
Vue.component('upload-images', require('./components/uploadImage/UploadImages.vue').default);
Vue.component('group-files', require('./components/fileGroup/fileGroup.vue').default);
Vue.component('search-user', require('./components/search/SearchUser.vue').default);
Vue.component('guest-component', require('./components/guest/GuestComponent.vue').default);
Vue.component('followers-info-component', require('./components/guest/FollowersInfoComponent.vue').default);
Vue.component('guest-images-component', require('./components/guest/GuestImagesComponent.vue').default);
Vue.component('profile-picture-component', require('./components/home/ProfilePictureComponent.vue').default);
Vue.component('settings-component', require('./components/settings/SettingsComponent.vue').default);
Vue.component('story-component', require('./components/stories/StoryComponent.vue').default);
Vue.component('story-modal', require('./components/stories/StoryModal.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
