import Vue from "vue" ;
import vuetify from "@/plugins/vuetify";

import Test from "@/pages/test/test" ;
new Vue({
    vuetify,
    render : (h)=>h(Test)
}).$mount("#test")