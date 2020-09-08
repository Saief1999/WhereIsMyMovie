<template>
    <v-container>
            <v-form
                    ref="form"
                    v-model="valid"
                    :lazy-validation="lazy"
                    method="POST"
                    id="reg-owner-gen-form">
                    <v-alert v-if="errorMessage.length!==0" type="error" dense class="multi-line">
                        {{errorMessage}}
                    </v-alert>
                    <v-row>

                        <v-col>
                            <v-text-field
                                    v-model="firstName"
                                    label="First Name"
                                    :rules="[v => !!v || 'First Name is required']"
                                    name="firstName"
                                    required></v-text-field>
                        </v-col>

                        <v-col>
                            <v-text-field
                                    v-model="lastName"
                                    :rules="[v => !!v || 'Last Name is required']"
                                    label="Last Name"
                                    name="lastName"
                                    required></v-text-field>
                        </v-col>
                    </v-row>

                    <v-text-field
                            v-model="username"
                            :rules="usernameRules"
                            label="Username"
                            name="username"
                            required></v-text-field>

                    <v-text-field
                            v-model="email"
                            :rules="emailRules"
                            label="E-mail"
                            name="email"
                            required></v-text-field>
                    <v-text-field
                            v-model="password"
                            :rules="passwordRules"
                            label="Password"
                            name="password"
                            :type="showPassword?'text':'password'"
                            :append-icon="showPassword?'mdi-eye':'mdi-eye-off'"
                            @click:append="showPassword=!showPassword"
                            required></v-text-field>

                    <v-text-field
                            v-model="repeatedPassword"
                            :rules="repeatedPasswordRule"
                            label="Repeat Password"
                            name="repeatedPassword"
                            :type="showRepeatedPassword?'text':'password'"
                            :append-icon="showRepeatedPassword?'mdi-eye':'mdi-eye-off'"
                            @click:append="showRepeatedPassword=!showRepeatedPassword"
                            required></v-text-field>


                <v-row>
                    <v-spacer></v-spacer>
                    <v-btn text href="/">Cancel</v-btn>
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
        name :'OwnerGeneral',
        computed :
            {
                repeatedPasswordRule(){
                    return [(this.password === this.repeatedPassword) || 'Passwords must match'];
                }

            },
        data() {
                return {
                    valid: false,
                    firstName :'' ,
                    lastName : ''  ,
                    username : '' ,
                    usernameRules :[
                        v => !!v || 'Username is required',
                        v=> /^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/.test(v) ||'Username must be valid'
                    ] ,
                    email: '',
                    emailRules: [
                        v => !!v || 'E-mail is required',
                        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                    ],
                    password: '',
                    passwordRules: [
                        v => !!v || 'Password is required',
                        v => (v && v.length >= 6) || 'Password must be greater than 6 characters',
                    ],
                    showPassword : false ,
                    repeatedPassword :'' ,
                    showRepeatedPassword : false ,
                    //validation of the repeated field is handled by computed property , to make it always change
                    // even without changing that specific field
                    lazy:true ,
                    errorMessage : '' ,
                    isLoading :false ,
                }
        } ,
        methods :{
            validate()
            {   if (this.$refs.form.validate())
                {this.triggerPageChange(2)}
            } ,
            triggerPageChange(n)
            {
                this.$emit("pagechange",n)
            }
        }
    }
</script>