import Vue from "vue" ;
import vuetify from "@/plugins/vuetify";

//signup
import SignUp from "@/pages/signup/signup" ;
new Vue({
    vuetify,
    render : (h)=>h(SignUp)
}).$mount("#vue-signup")