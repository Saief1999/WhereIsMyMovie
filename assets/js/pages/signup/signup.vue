<template>
    <v-app class="fancy-bg">
        <v-main >
            <v-container>
                <v-card>
                    <v-card-title class="text-center justify-center py-6">
                        <h1 class="font-weight-bold display-3 basil--text">Sign Up</h1>
                    </v-card-title>
                    <v-tabs
                            v-model="tab"
                            background-color="transparent"
                            color="#356859"
                            grow>
                        <v-tab
                                v-for="item in items"
                                :key="item.title">
                            {{ item.title }}
                        </v-tab>
                    </v-tabs>

                    <v-tabs-items v-model="tab">
                        <v-tab-item
                                v-for="item in items"
                                :key="item.title">
                            <v-card
                                    flat>
                                <v-card-text>
                                    <div :is="item.component"></div>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>
                    </v-tabs-items>
                </v-card>
            </v-container>
        </v-main>
    </v-app>
</template>
<script>

    import userSignup from "@/components/signup/userSignup";
    import ownerSignup from "@/components/signup/ownerSignup";
    export default {
        name : 'Signup' ,
        components : {userSignup,ownerSignup},
        data () {
            return {
                tab: null ,
                items: [
                    {title :'SignUp as User' ,component : 'user-signup'},
                    {title :'SignUp as Owner',component :'owner-signup'},
                ],
            }
        },
    }
</script>


<style scoped>
    /* Helper classes */
    .basil {
        background-color: #FFFBE6 !important;
    }
    .basil--text {
        color: #356859 !important;
    }

    .fancy-bg{
        background: url("http://oc-images.imgix.net/backgrounds/bg_oc_things_grey.png?auto=compress,format&q=80$image");
    }

</style>