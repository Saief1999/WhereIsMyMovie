<template>
    <v-container>
        <v-stepper v-model="e1">
            <v-stepper-header>
                <v-stepper-step :complete="e1 > 1" step="1">General Information</v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step :complete="e1 > 2" step="2">Cinema Information</v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step step="3">Something else</v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
                <v-stepper-content step="1">
 <!--                   <v-card
                            class="mb-12"
                            color="grey lighten-1"
                            height="200px"></v-card>

                    <v-btn
                            color="primary"
                            @click="e1 = 2">
                        Continue
                    </v-btn>
                    <v-btn text>Cancel</v-btn>-->
                    <owner-general v-on:pagechange="e1=$event"></owner-general>
                </v-stepper-content>

                <v-stepper-content step="2">
                    <owner-cinema v-on:pagechange="e1=$event"></owner-cinema>
                </v-stepper-content>

                <v-stepper-content step="3">
                    <v-card
                            class="mb-12"
                            color="grey lighten-1"
                            height="200px">
                    </v-card>

                    <v-btn
                            color="primary" @click="e1=1">
                        Submit
                    </v-btn>

                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>

            </v-stepper-items>
        </v-stepper>
    </v-container>
</template>


<script>

    import OwnerGeneral from "@/components/signup/ownerGeneral";
    import OwnerCinema from "@/components/signup/ownerCinema";
    export default {
        name : 'OwnerSignup',
        data () {
            return {
                e1: 1,
            }
        },
        components: {OwnerGeneral,OwnerCinema}
    }
</script>