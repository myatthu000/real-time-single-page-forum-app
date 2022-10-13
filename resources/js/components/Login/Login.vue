<template>
    <v-form @submit.prevent="login">
        <v-text-field
            v-model="form.email"
            label="E-mail"
            type="email"
        ></v-text-field>

        <v-text-field
            v-model="form.password"
            label="P-assword"
            type="password"
        ></v-text-field>

        <v-btn
            color="success"
            type="submit"
        >
            Login
        </v-btn>
    </v-form>
</template>

<script>
    import axios from "axios"
    export default {
        data() {
            return {
                form:{
                    email:null,
                    password:null
                }
            }
        },
        methods: {
           login(){
               User.login(this.form)
           }
        },
    }
</script>

<style>

</style>
