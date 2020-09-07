import Vue from "vue" ;
import vuetify from "@/plugins/vuetify";

//Plannings
import Plannings from "@/pages/plannings/plannings" ;
new Vue({
    vuetify,
    render : (h)=>h(Plannings)
}).$mount("#vue-plannings")