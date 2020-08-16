/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import Vue from 'vue'
import Header from '@/components/header'
import Footer from '@/components/footer'


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

//rendering footer and header
new Vue({
    render:(h)=>h(Header)
}).$mount("#js-header") ;

new Vue({
    render:(h)=>h(Footer)
}).$mount("#js-footer") ;




