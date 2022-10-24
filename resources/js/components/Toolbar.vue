<template>
    <v-toolbar
        elevation="4"
    >
        <v-toolbar-title>Forum App</v-toolbar-title>

        <v-spacer></v-spacer>

        <div class="hidden-sm-and-down">
            <router-link
                v-if='item.show'
                v-for="item in items"
                :key="item.title"
                :to="item.to">
                <v-btn text>{{item.title}}</v-btn>
            </router-link>
        </div>

        <v-menu
            left
            bottom
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    icon
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
            </template>

            <v-list>
                <v-list-item
                    v-for="n in 5"
                    :key="n"
                    @click="() => {}"
                >
                    <v-list-item-title>Option {{ n }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </v-toolbar>
</template>

<script>
import User from './Helpers/User';

    export default {
        data() {
            return {
                items: [
                    {title:'Forum', to:'/forum', show:true},
                    {title:'Ask Question', to:'/askQuestion', show:User.loggedIn()},
                    {title:'Category', to:'/category', show:User.admin()},
                    {title:'SignUp', to:'/signup', show:!User.loggedIn()},
                    {title:'Logout', to:'/logout', show:User.loggedIn()},
                    {title:'Login', to:'/login', show:!User.loggedIn()},
                ]
            }
        },
        created () {
            EventBus.$on("logout",() => {
                User.logout();
            });
        },
    }
</script>

<style>

</style>
