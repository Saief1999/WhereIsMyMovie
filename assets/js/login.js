import Vue from "vue" ;
import vuetify from "@/plugins/vuetify";

//login
import Login from "@/pages/login/login" ;
new Vue({
    vuetify,
    render : (h)=>h(Login)
}).$mount("#vue-login")