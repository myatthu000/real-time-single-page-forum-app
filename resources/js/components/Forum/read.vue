<template>
    <div v-if="question">
        <editQuestion v-if="editing" :data="question"></editQuestion>

        <div v-else>
            <ShowQuestion :data="question"></ShowQuestion>
        </div>

        <v-container>

            <Replies :question="question"></Replies>

            <new-reply v-if="loggedIn" :questionSlug="question.slug"></new-reply>
            <div class="mt-4" v-else>
                <router-link to='/login'>Login in to Reply</router-link>
            </div>
        </v-container>

    </div>
</template>
 
<script>

import Replies from '../replies/Replies.vue';
import NewReply from '../replies/NewReply.vue';
import axios from 'axios';
import ShowQuestion from "./ShowQuestion.vue"
import editQuestion from "./editQuestion.vue"

export default {
    components: {
        ShowQuestion,
        editQuestion,
        NewReply,
        Replies,
    },
    data() {
        return {
            question: null,
            editing: false,
        }
    },
    computed: {
        loggedIn() {
            return User.loggedIn();
             
        }
    },
    methods: {

        listen() {
            EventBus.$on("startEditing", () => {
                this.editing = true;
            })
            EventBus.$on("cancelEditing", () => {
                this.editing = false;
            })
        },
        getQuestion() {
            // console.log(this.$route.params.slug)
            axios.get(`/api/question/${this.$route.params.slug}`)
                .then(response => {
                    console.log("from read", response.data.data['replies'])
                    this.question = response.data.data;
                });
        }
    },
    created() {
        this.listen();
        this.getQuestion();
    },
}
</script>

<style lang="scss" scoped>

</style>