<template >
    <v-app  class="fancy-bg">
        <v-main>
            <v-container >
                <v-row
                       justify="center">
                    <v-col
                            cols="12"
                            sm="8"
                            md="6">
                        <v-card class="mt-15">
                            <v-card-title class="justify-center">
                                <h2>Sign in</h2>
                            </v-card-title>
                            <!--                            <v-card-subtitle>
                                                            <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                                        </v-card-subtitle>-->
                            <v-form
                                    ref="form"
                                    v-model="valid"
                                    :lazy-validation="lazy"
                                    method="POST"
                                    @submit.prevent="validate"
                                    id="login-form"
                            >
                                <input type="hidden" name="_csrf_token" :value="token">
                                <v-card-text>
                                    <v-alert v-if="errorMessage.length!==0" type="error" dense>
                                        {{errorMessage}}
                                    </v-alert>
                                    <v-text-field
                                            v-model="email"
                                            :rules="emailRules"
                                            label="E-mail"
                                            name="email"
                                            prepend-icon="mdi-account"
                                            required></v-text-field>
                                    <v-text-field
                                            v-model="password"
                                            :rules="passwordRules"
                                            label="Password"
                                            name="password"
                                            :type="showPassword?'text':'password'"
                                            prepend-icon="mdi-lock"
                                            :append-icon="showPassword?'mdi-eye':'mdi-eye-off'"
                                            @click:append="showPassword=!showPassword"
                                            required></v-text-field>
                                    <v-row>
                                        <v-col> <v-checkbox v-model="rememberMe" label="Remember me" name="_remember_me" value="on" ></v-checkbox></v-col>
                                        <v-spacer></v-spacer>
                                       <v-col><a href="#">Forgot your password? </a></v-col></v-row>

                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                            :disabled="!valid"
                                            color="success"
                                            class="mr-4"
                                            type="submit"
                                             block
                                            :loading="isLoading"
                                    >
                                        Login
                                    </v-btn>
                                </v-card-actions>
                                <v-card-text>
                                    <v-layout justify-center>
                                        <div>
                                            Don't have an account yet? <a href="/signup" >Sign up for free </a>
                                        </div>
                                    </v-layout>
                                </v-card-text>
                            </v-form>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    import {getToken} from "@/services/loginPage";
    import {authentication} from "@/services/loginPage";

    export default {
        name:'Login' ,
        data: () => ({
            token : getToken() ,
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
            rememberMe : false ,
            errorMessage : '' ,
            isLoading :false
        }),

        methods: {
             validate () {
                 this.isLoading=true ;
                 this.errorMessage="" ;
               if (this.$refs.form.validate()) {
                   authentication($("#login-form")[0])
                   .then((response)=>{
                       let data = response.data ;
                       if (data.success){
                          window.location.href="/" ;
                       }
                       else {
                          this.errorMessage= data.message ;
                          this.isLoading=false ;
                       }
                   })
                   .catch( ()=> {
                      this.errorMessage= "Server Error!" ;
                       this.isLoading=false ;
                       });
                    }
               else {
                   this.isLoading=false ;
               }
               }
        },
    }
</script>

<style scoped>
    button {
        outline:none
    }
    .fancy-bg{
        background: url("http://oc-images.imgix.net/backgrounds/bg_oc_things_grey.png?auto=compress,format&q=80$image");
    }

</style>