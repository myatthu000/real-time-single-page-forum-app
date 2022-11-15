<template>
    <div>
        <v-btn text @click="likeIt">
            <v-icon :color="color">mdi-heart</v-icon> <span> {{ count }} </span>
        </v-btn>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ['content'],
    data() {
        return {
            count: this.content.like_count,
            liked: this.content.liked,
        }
    },
    computed: {
        color() {
            return this.liked ? "red" : "black";
        }
    },
    created () {
        this.realtimeLike();
    },
    methods: {
        likeIt() {
            if (User.loggedIn()) {
                this.liked ? this.decr() : this.incr();
                this.liked = !this.liked;
                console.log(this.liked)
            }
        },
        incr() {
            axios.post(`/api/like/${this.content.id}`)
                .then(response => {
                    this.count++;
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
        decr() {
            axios.delete(`/api/like/${this.content.id}`)
                .then(response => {
                    this.count--;
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
        realtimeLike() {
            Echo.channel('LikeChannel')
                .listen("LikeEvent", (e) => {
                    if(this.content.id == e.id){
                        e.type == 1 ? this.count ++ : this.count -- ;
                        console.log(e)
                    }
                })
        }
    },
}
</script>

<style lang="scss" scoped>

</style>