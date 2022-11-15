<template>
    <div class="mb-3">
        <v-card>

            <v-card-title>
                <div class="headline ">{{ data.user }}</div>

                <div class="ml-2">
                    said {{ data.created_at }}
                </div>
            </v-card-title>

            <edit-reply 
            v-if="editing"
            :reply="data"
            ></edit-reply>
            <v-card-text v-else v-html="reply"></v-card-text>

            <Like :content="data"></Like>

            <v-divider></v-divider>

            <div class="" v-if="!editing">
                <v-card-actions v-if="own">
                    <v-btn small color="orange" @click="edit">Edit</v-btn>
                    <v-btn small color="red" @click="destroy">Delete</v-btn>
                </v-card-actions>
            </div>

        </v-card>
    </div>
</template>

<script>
import axios from 'axios';
import { marked } from 'marked';
import editReply from "./editReply.vue"
import Like from "../Like/Like.vue"

export default {
    props: ["data", "index"],
    data() {
        return {
            editing: false,
        }
    },
    components: {
        editReply,Like
    },
    created () {
        this.listen();
    },
    computed: {
        own() {
            return User.own(this.data.user_id);
        },
        reply() {
            return marked.parse(this.data.reply);
        }
    },
    methods: {
        listen(){
            EventBus.$on("cancelEditing",()=>{
                this.editing = false;
            })
        },
        destroy() {
            EventBus.$emit("deleteReply", this.index);
        },
        edit() {
            this.editing = true;
            console.log(this.data)
        }
    },

}
</script>

<style lang="scss" scoped>

</style>