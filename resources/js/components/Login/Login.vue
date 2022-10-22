<template>
    <v-container>
        <v-form @submit.prevent="login">
            <v-text-field
                v-model="form.email"
                label="E-mail"
                type="email"
            ></v-text-field>
            <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>

            <v-text-field
                v-model="form.password"
                label="P-assword"
                type="password"
            ></v-text-field>
            <span class="red--text" v-if="errors.password">{{ errors.password }}</span>


            <v-btn
                color="success"
                type="submit"
            >
                Login
            </v-btn>



            <router-link to="/signup">
                <v-btn
                    color="pale blue"
                    type="submit"
                >
                    Signup
                </v-btn>
            </router-link>
        </v-form>
    </v-container>
</template>

<script>
    import axios from "axios"
    export default {
        data() {
            return {
                form:{
                    email:null,
                    password:null
                },
                errors:{}
            }
        },
        methods: {

           login(){
               console.log(this.form)
               User.login(this.form)
                // this.$router.push({name:"forum"})
           }

        },
    }
</script>

<style>

</style>
