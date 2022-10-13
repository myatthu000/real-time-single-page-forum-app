<template>
    <v-toolbar
        elevation="4"
    >

        <v-toolbar-title>Forum App</v-toolbar-title>

        <v-spacer></v-spacer>

        <div class="hidden-sm-and-down">
            <router-link to="/forum">
                <v-btn text>Forum</v-btn>
            </router-link>

            <router-link to="/askQuestion">
                <v-btn text>Ask Question</v-btn>
            </router-link>

            <router-link to="/">
                <v-btn text>Category</v-btn>
            </router-link>

            <router-link to="/login">
                <v-btn text>Login</v-btn>
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
    export default {

    }
</script>

<style>

</style>
