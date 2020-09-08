<template>
    <v-container>
        <v-form
                ref="form"
                v-model="valid"
                :lazy-validation="lazy"
                method="POST"
                id="reg-owner-cin-form">
            <v-alert v-if="errorMessage.length!==0" type="error" dense class="multi-line">
                {{errorMessage}}
            </v-alert>


                    <v-text-field
                            v-model="cinemaName"
                            label="Cinema Name"
                            :rules="[v => !!v || 'First Name is required']"
                            name="cinemaName"
                            required></v-text-field>

            <v-textarea
                    v-model="cinemaDescription"
                    label="Cinema Description"
                    name="cinemDescription"
            ></v-textarea>

            <v-row>
                <v-col cols="11" sm="5">
                    <v-menu
                            ref="menu"
                            v-model="menu2"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            :return-value.sync="time"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="290px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                    v-model="cinemaOpeningTime"
                                    label="Opening Time"
                                    prepend-icon="mdi-clock-time-three"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                            ></v-text-field>
                        </template>
                        <v-time-picker
                                v-if="menu2"
                                v-model="time"
                                full-width
                                @click:minute="$refs.menu.save(time)"
                        ></v-time-picker>
                    </v-menu>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="11" sm="5">
                    <v-dialog
                            ref="dialog"
                            v-model="modal2"
                            :return-value.sync="time"
                            persistent
                            width="290px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                    v-model="cinemaClosingTime"
                                    label="Closing Time"
                                    prepend-icon="mdi-clock-time-ten"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                            ></v-text-field>
                        </template>
                        <v-time-picker
                                v-if="modal2"
                                v-model="time"
                                full-width>
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="modal2 = false">Cancel</v-btn>
                            <v-btn text color="primary" @click="$refs.dialog.save(time)">OK</v-btn>
                        </v-time-picker>
                    </v-dialog>
                </v-col>
            </v-row>

            <v-row>
                <v-spacer></v-spacer>
                <v-btn
                        @click="triggerPageChange(1)">
                    <v-icon dark left>mdi-arrow-left</v-icon>
                    Back
                </v-btn>
                <v-btn
                        :disabled="!valid"
                        color="success"
                        @click="validate">
                    Continue
                    <v-icon dark right>mdi-arrow-right</v-icon>
                </v-btn>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        name :'OwnerCinema',
        computed :
            {
                repeatedPasswordRule(){
                    return [(this.password === this.repeatedPassword) || 'Passwords must match'];
                }

            },
        data() {
            return {
                cinemaName : ''  ,
                cinemaDescription : '' ,
                cinemaOpeningTime :null ,
                cinemaClosingTime :null ,
                cinemaImage :'' ,
                valid: false,
                lazy:true ,
                errorMessage : '' ,
                isLoading :false ,
                time: null,
                menu2: false,
                modal2: false,
            }
        } ,
        methods :{
            validate()
            {   if (this.$refs.form.validate())
            {this.triggerPageChange(3)}
            } ,
            triggerPageChange(n)
            {
                this.$emit("pagechange",n)
            }
        }
    }
</script>