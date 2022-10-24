<template>
    <v-card max-width="450" class="mx-auto">
        <v-toolbar color="cyan" dark dense>

            <v-toolbar-title>Inbox</v-toolbar-title>

            <v-spacer></v-spacer>

        </v-toolbar>

        <v-list v-if="categories">
            <!-- <template> -->
                <v-list-item v-for="category in categories" :key="category.id">
                    <v-list-item-content >
                        <v-list-item-title>{{ category.name }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            <!-- </template> -->
        </v-list>
    </v-card>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: null,
        }
    },
    created () {
        axios.get("/api/category")
            .then(response =>{
                // console.log(response.data.data)
                this.categories = response.data.data
            })
            .catch(error =>{
                console.log(error.response.data)
            });
    },
}
</script>

<style lang="scss" scoped>

</style>