<template>
    <div>
        <div v-if="question">
            <SingleReply 
            :index="i"
            v-for="(reply, i) in content"
            :key="reply.id"
            :data="reply"></SingleReply>
        </div>
    </div>
</template>

<script>

import SingleReply from './SingleReply.vue'
import axios from 'axios';


export default {
    data() {
        return {
            content: this.question.replies
        }
    },
    props: ["question"],
    components: {
        SingleReply,
    },
    created() {
        this.listen();
    },
    methods: {
        listen() {

            EventBus.$on("newReply", (reply) => {
                this.content.unshift(reply);
                window.scrollTo(0, 0);
            })

            EventBus.$on("deleteReply", (index) => {
                axios.delete(`/api/question/${this.question.slug}
                    /reply/${this.content[index].id}`)
                    .then(response => {
                        this.content.splice(index, 1);
                    })
                    .catch(error => {
                        //
                    })
            })


            Echo.private('App.Models.User.' + User.id())
                .notification((notification) => {
                    this.content.unshift(notification.reply)
                    console.log(notification.type);
                });

            Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent', (e) => {
                    // console.log(e);
                    for (let index = 0; index < this.content.length; index++) {
                        if (this.content[index].id == e.id) {
                            this.content.splice(index,1)
                        }
                    }
                });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>