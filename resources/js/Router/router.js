import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from "../components/Login/Login";
import Signup from "../components/Login/Signup";
import Forum from "../components/Forum/Forum";
import read from "../components/Forum/read";
import create from "../components/Forum/create";
// import askQuestion from "../components/Forum/askQuestion";
import Logout from "../components/Login/Logout";

const routes = [
    { 
        path: '/login', 
        component: Login 
    },
    { 
        path: '/signup', 
        component: Signup 
    },
    { 
        name: "forum" ,
        path: '/forum', 
        component: Forum, 
    },
    { 
        name: "read",
        path: '/question/:slug', 
        component: read, 
    },
    { 
        path: '/askQuestion', 
        component: create, 
    },
    
    // { path: '/askQuestion', component: askQuestion, name: "question" },
    { 
        name: "logout",
        path: '/logout', 
        component: Logout, 
    },

]


const router = new VueRouter({
    routes,
    mode: 'history',
    allowHashBang: "false"
})

export default router
