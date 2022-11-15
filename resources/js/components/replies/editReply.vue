<template>
    <div>
        <vue-editor v-model="reply.reply"></vue-editor>
        <v-card-actions>
            <v-btn small color="#00C853" @click="update">Save</v-btn>
            <v-btn small color="#212121" dark @click="cancel">Cancel</v-btn>
        </v-card-actions>
    </div>
</template>

<script>
import { VueEditor } from 'vue2-editor';
import axios from 'axios';
export default {
    props: ["reply"],
    components: {
        VueEditor,
    },
    methods: {
        update() {
            axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,{body:this.reply.reply})
                .then(response => {
                    // console.log(response.data);
                    this.cancel();
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
        cancel(){
            EventBus.$emit("cancelEditing");
        }
    },

}
</script>

<style lang="scss" scoped>

</style>