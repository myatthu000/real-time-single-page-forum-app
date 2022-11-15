<template>
    <div class="">
        <v-card class="mb-3">
            <div class="">
                <v-card-title>
                    <div class="headline">{{ data.title }}</div>
                </v-card-title>

                <v-card-subtitle class="py-3">
                    <!-- <router-link :to="data.user"> -->
                    <strong>
                        {{ data.user }}
                    </strong>
                    <!-- </router-link> -->
                    said
                    {{ data.created_at }}
                </v-card-subtitle>
            </div>
            <div>
                <v-card-title class="text--primary">
                    <div v-html="body">
                        <!-- {{ data.body }} -->
                    </div>
                </v-card-title>
            </div>


            <div v-if="own" class="mb-3 flex justify-content-center align-item-center flex-wrap">
                <v-btn color="orange" @click="edit">
                    Edit
                </v-btn>
                <v-btn color="red" @click="destroy">
                    Delete
                </v-btn>
            </div>
            <!-- <v-spacer></v-spacer> -->
            <v-btn color="white">{{ replyCount }} Replies</v-btn>

        </v-card>

    </div>
</template>

<script>
import { marked } from 'marked';


export default {
    data() {
        return {
            own: User.own(this.data.user_id),
            replyCount: this.data.reply_count
        }
    },

    props: ["data"],
    computed: {
        body() {
            return marked.parse(this.data.body);
        }
    },
    methods: {
        destroy() {
            axios.delete(`/api/question/${this.data.slug}`)
                .then(response => this.$router.push("/forum"))
                .catch(error => console.log(error.response.data))
        },
        edit() {
            EventBus.$emit("startEditing")
        }
    },
    created() {

        // from frontend reply count increase
        EventBus.$on("newReply", () => {
            this.replyCount++
        })

        // for frontend realtime reply count increase
        Echo.private('App.Models.User.' + User.id())
            .notification((notification) => {
                this.replyCount++
            });

        // from frontend reply count decrease
        EventBus.$on("deleteReply", (index) => {
            // console.log(index)
            this.replyCount--
        })

        // for frontend realtime reply count delete
        Echo.channel('deleteReplyChannel')
            .listen('DeleteReplyEvent', (e) => {
                this.replyCount--
            });

    },
}

</script>

<style lang="scss" scoped>

</style>
