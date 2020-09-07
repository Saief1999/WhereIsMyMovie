<template>
            <v-snackbar
                    v-model="snackbar.state"
                    :color="snackbar.color"
                    :right="true"
                    :timeout="5000"
                    :bottom="true">
                {{snackbar.message}}
                <template  v-slot:action="{ attrs }">
                    <v-btn
                            dark
                            text
                            v-bind="attrs"
                            @click="snackbar.state = false">
                        Close
                    </v-btn>
                </template>
            </v-snackbar>
</template>

<script>
    import {getFlash} from "@/services/flash-messages";

    export default {
        name: "plannings",
        mounted(){
            let key=null ;
            if (this.flashMessages["error"].length!==0)
                key="error";
                else if (this.flashMessages["info"].length!==0)
                    key="info";
                else if (this.flashMessages["success"].length!==0)
                    key="success";

            if (key!=null)
            {
                this.snackbar.message= this.flashMessages[key][0] ;
                this.snackbar.color=key ;
                this.snackbar.state=true ;
            }
    },
        data(){return {
            flashMessages: getFlash()  ,
            snackbar : {state : false ,
                        color : "success" ,
                        message :""
                    }}
        }
    }
</script>

<style scoped>

</style>