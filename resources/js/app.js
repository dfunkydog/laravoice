/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Modal from "./components/Modal";
import SetPeriod from "./components/SetPeriod";
window.Vue = require("vue");
window.Event = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("modal", Modal);
Vue.component("set-period", SetPeriod);

const app = new Vue({
    el: "#app",
    data: {
        showPeriodSelect: false
    },
    methods: {
        close: function() {
            this.showPeriodSelect = false;
        }
    }
});
