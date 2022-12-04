<template>
    <!-- fff  -->
    <v-toolbar
        elevation="1"
    >
        <v-toolbar-title>
            <router-link class="black--text" to="/">Forum</router-link>
        </v-toolbar-title>

        <v-spacer></v-spacer>

        <AppNotification></AppNotification>

        <div class="hidden-sm-and-down">

            <div>
                <router-link
                    v-if='item.show'
                    v-for="item in items"
                    :key="item.title"
                    :to="item.to">
                    <v-btn text>{{item.title}}</v-btn>
                </router-link>
            </div>

        </div>

        <div class="d-xl-none d-lg-none d-md-none">
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
                v-if='item.show'
                    v-for="(item,n) in items"
                    :key="n"
                    :to="item.to">
                    <v-list-item-title>
                        {{ item.title }}
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
        </div>
    </v-toolbar>
</template>

<script>
import User from './Helpers/User';
import AppNotification from './AppNotification.vue';

    export default {
        components: {
            AppNotification,
        },
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
