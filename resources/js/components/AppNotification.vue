<template>
    <div class="text-center">
        <v-menu offset-y>

            <template v-slot:activator="{ on, attrs }">
                <v-btn icon v-bind="attrs" v-on="on">
                    <v-icon color="yellow darken-2">mdi-bell</v-icon> {{ unreadCount }}
                </v-btn>
            </template>

            <v-list v-if="unreadCount > 0">
                <v-list-item v-for="item in unread" :key="item.id">
                    <router-link :to="item.path">
                        <v-list-item-title @click="readIt(item)">
                            {{ item.question.length > 5 ? item.question.substring(0, 5) + "..." : item.question }} reply
                            by
                            {{ item.replyBy }}
                        </v-list-item-title>
                    </router-link>
                </v-list-item>
            </v-list>

            <v-list v-for="item in read" :key="item.id">
                <v-list-item>
                    {{ item.question.length > 5 ? item.question.substring(0, 5) + "..." : item.question }}
                </v-list-item>
            </v-list>

        </v-menu>
    </div>
</template>

<script>
import axios from 'axios';
import Exception from './Helpers/Exception';


export default {
    data() {
        return {
            read: {},
            unread: {},
            unreadCount: 0,
            sound: "http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3",
        }
    },
    created() {
        if (User.loggedIn()) {
            this.getNotifications();
            this.realtimeNoti();
        };
        
    },
    methods: {
        
        getNotifications() {
            axios.post("/api/notifications")
                .then(response => {
                    this.read = response.data.read
                    this.unread = response.data.unread
                    this.unreadCount = response.data.unread.length
                })
                .catch(error => {
                    Exception.handle(error);
                });
        },
        realtimeNoti(){
            Echo.private('App.Models.User.' + User.id())
            .notification((notification) => {
                this.unread.unshift(notification)
                this.unreadCount++
                this.playNotiSong
            });
        },
        playNotiSong(){
            let alert = new Audio(this.sound);
            alert.play();
            // console.log("hello audio");
        },
        readIt(notification) {
            axios.post("/api/markAsRead", { id: notification.id }).then(response => {
                // console.log(notification.id,"/n",notification)
                this.unread.splice(notification, 1);
                this.read.push(notification);
                this.unreadCount--;
            })
        },
    
    },
    computed: {
        color() {
            return this.unreadCount > 0 ? "yellow darken-2" : "red lighten-4"
        }
    },
}
</script>

<style lang="scss" scoped>

</style>