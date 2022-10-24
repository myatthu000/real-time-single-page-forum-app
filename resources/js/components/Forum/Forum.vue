<template>
    <div>
        <h3>Forum</h3>
        <v-container fluid grid-list-md>
            <v-layout row wrap>
                <v-flex xs8>
                    <question v-for="question in questions" :key="question.path" :data="question">
                    </question>
                </v-flex>
                <v-flex xs4>
                   <AppSidebar></AppSidebar>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";
import question from "./question.vue";
import AppSidebar from "./AppSidebar.vue";

export default {
    data() {
        return {
            questions: {}
        }
    },
    components: { question,AppSidebar },
    created() {
        axios.get("/api/question")
            .then(response => {
                // console.log(response.data)
                this.questions = response.data.data;
            })
            .catch(error => {
                console.log(error.response.data)
            });
    },
}
</script>

<style scoped>

</style>
