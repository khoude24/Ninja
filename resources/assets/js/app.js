/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component('word', require('./components/Word.vue'));


// resources/assets/sass/app.scss // Font Awesome
require( "font-awesome/scss/font-awesome.scss");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        isShow: false,
        name: ''
    },


    methods: {
        greet: function (event) {
            if ($('input[name=hidden-tags]').val()==""){
                alert('No awesome words detected, remember, you need to seperate words with enter, comma, or tab');
            } else {
                axios.get('/ninjify', {
                    params: {
                        x: $('input[name=hidden-tags]').val(),
                        secret: $('#secret').val()
                    }
                })
                .then(function (response) {
                    this.isShow = true;
                    this.name = response.data;
                    $("#twitter_link").attr("href", 'https://twitter.com/intent/tweet?text=My ninja name is ' + this.name +' &amp;url=https://ninja.test/');


                }.bind((this)))
            }
        }
    }
});


var KonamiCode = require( "konami-code" );
var konami = new KonamiCode();

konami.listen(function () {
    alert('Pirate mode activated!')
    $("body").addClass("konami");
    $('.job').text('pirate');
    $('#secret').val('pirate_mode');
    $(".job_img").attr("src","img/captain-hoarrd.png");
});


