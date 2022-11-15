<template>
    <div>
        <v-form @submit.prevent="create">
            <h1>New Reply</h1>
            <vue-editor label="Description" class="mb-3" v-model="form.body"></vue-editor>
            <v-btn small type="submit" color="#448AFF">
                Create
            </v-btn>
        </v-form>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                body: null,
            }
        }
    },
    props:["questionSlug"],
    components: {
        VueEditor,
    },
    methods: {
        create() {
            console.log(this.form);
            axios.post(`/api/question/${this.questionSlug}/reply`,this.form)
            .then(response =>{
                console.log("555",response.data);
                this.form = {};
                EventBus.$emit("newReply",response.data.reply);
            })
            .catch(error => {
                console.log(error.response.data)
            })
        }
    },

}
</script>

<style lang="scss" scoped>

</style>