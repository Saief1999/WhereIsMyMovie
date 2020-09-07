<template>
    <v-app>
        <v-main>
            <v-container
                    class="fill-height"
                    fluid>
                <v-row align="center"
                       justify="center">
                    <v-col
                            cols="12"
                            sm="8"
                            md="6">
                        <v-card class="justify-center">
                            <v-card-title>
                                <h2>Sign in</h2>
                            </v-card-title>
                            <v-form
                                    ref="form"
                                    v-model="valid"
                                    :lazy-validation="lazy">
                                <v-card-text>

                                    <v-text-field
                                            v-model="email"
                                            :rules="emailRules"
                                            label="E-mail"
                                            prepend-icon="mdi-account"
                                            required></v-text-field>
                                    <v-text-field
                                            v-model="password"
                                            :rules="passwordRules"
                                            label="Password"
                                            :type="showPassword?'text':'password'"
                                            prepend-icon="mdi-lock"
                                            :append-icon="showPassword?'mdi-eye':'mdi-eye-off'"
                                            @click:append="showPassword=!showPassword"
                                            required></v-text-field>

                                    <div><a href="#">Forgot your password? </a></div>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn color="primary">Login</v-btn>
                                    <v-btn
                                            :disabled="!valid"
                                            color="success"
                                            class="mr-4"
                                            @click="validate">
                                        Validate
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        name:'Test' ,
        data: () => ({
            valid: false,

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
            lazy:true ,
        }),

        methods: {
            validate () {
                this.$refs.form.validate()
            },
        },
    }
</script>