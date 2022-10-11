<template>
    <v-toolbar
        elevation="4"
    >

        <v-toolbar-title>Forum App</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn text>Forum</v-btn>
            <v-btn text>Ask Question</v-btn>
            <v-btn text>Category</v-btn>
            <v-btn text>Login</v-btn>
        </v-toolbar-items>

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
