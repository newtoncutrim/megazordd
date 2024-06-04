/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'bootstrap'
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import VueTheMask from 'vue-the-mask'
import TheBanner from './TheBanner.vue'

window.Vue = Vue

Vue.use(VueTheMask)
Vue.use(VueSweetalert2)

const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  timer: 1500,
  showConfirmButton: true,
})
window.Toast = Toast

Vue.component('the-banner', TheBanner)

const app = new Vue({
  el: '#app',
})
