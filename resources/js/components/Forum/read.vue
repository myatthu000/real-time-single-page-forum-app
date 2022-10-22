<template>
    <div v-if="question">
        <editQuestion v-if="editing" :data="question"></editQuestion>

        <div v-else>
            <ShowQuestion :data="question"></ShowQuestion>
        </div>
    </div>
</template>
 
<script>
import axios from 'axios';
import ShowQuestion from "./ShowQuestion.vue"
import editQuestion from "./editQuestion.vue"

export default {
    components: {
        ShowQuestion,
        editQuestion
    },
    data() {
        return {
            question: null,
            editing: false,
        }
    },
    methods: {

        listen() {
            EventBus.$on("startEditing", () => {
                this.editing = true;
            })
            EventBus.$on("cancelEditing",()=>{
                this.editing = false;
            })
        },
        getQuestion() {
            // console.log(this.$route.params.slug)
            axios.get(`/api/question/${this.$route.params.slug}`)
                .then(response => {
                    // console.log("from read",response.data.data)
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