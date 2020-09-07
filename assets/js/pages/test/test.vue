<template>
    <v-app>
        <v-main>
<v-row>
    <v-container>
        <v-img :src="require('js-images/about.jpg')"></v-img>
    </v-container>
</v-row>
            <v-row >
                <v-col cols="6" class="mx-auto">

                    <v-btn block @click="snackbar =true">Show flash message</v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6" class="mx-auto">
                    <v-btn block @click="changeShit()">Go To Link</v-btn>
                </v-col>
            </v-row>

            <v-snackbar
                    v-model="snackbar"
                    color="success"
                    :right="true"
                    :timeout="3000"
                    :top="true">
                {{ flashMessage }}

                <template v-slot:action="{ attrs }">
                    <v-btn
                            dark
                            text
                            v-bind="attrs"
                            @click="snackbar = false">
                        Close
                    </v-btn>
                </template>
            </v-snackbar>


        </v-main>
    </v-app>

</template>


<script>
export default {
    name :'test',
    data()
    {
        return {flashMessage : 'Logged in Successfully',
                    snackbar :false
        }
    } ,
    methods :
        {
            changeShit()
            {
                window.location.href = "http://www.w3schools.com";
            },
        }
}
</script>


<style scoped>
    button {
        outline:none
        }
</style>