<template>
    <v-form @submit.prevent="signup">
        <v-text-field
            v-model="form.name"
            label="name"
            type="text"
        ></v-text-field>
        <span class="red--text" v-if="errors.name">{{ errors.name[0] }}</span>

        <v-text-field
            v-model="form.email"
            label="E-mail"
            type="email"
        ></v-text-field>
        <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>


        <v-text-field
            v-model="form.password"
            label="Password"
            type="password"
        ></v-text-field>
        <span class="red--text" v-if="errors.password">Password is Invalid or doesn't match.</span>


        <v-text-field
            v-model="form.password_confirmation"
            label="Confirm Password"
            type="password"
        ></v-text-field>
<!--        <span class="red&#45;&#45;text" v-if="errors.password">{{ errors.password[0] }}</span>-->


        <v-btn
            color="success"
            type="submit"
        >
            Signup
        </v-btn>

        <router-link to="/login">
            <v-btn
                color="pale blue"
                type="submit"
            >
                Login
            </v-btn>
        </router-link>

    </v-form>

</template>

<script>
    import axios from "axios"
    export default {
        data() {
            return {
                form: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                },
                errors: {}

            }
        },
        methods: {
            signup() {
                axios.post("/api/auth/signUp/",this.form)
                    .then(response => {
                        User.responseAfterLogin(response);
                        this.$router.push({name:"forum"})
                        // console.log(response)
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
                        // console.log(error.response.data.errors)
                        // console.log(this.errors)
                    })
            }
        },
    }
</script>

<style scoped>

</style>
