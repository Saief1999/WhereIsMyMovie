import Vue from "vue" ;
import vuetify from "@/plugins/vuetify";

//login
import Index from "@/pages/index/index" ;
new Vue({
    vuetify,
    render : (h)=>h(Index)
}).$mount("#vue-index")