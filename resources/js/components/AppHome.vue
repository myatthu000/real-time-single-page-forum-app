<template>
    <div>
        <Toolbar></Toolbar>
        <v-container class="my-2 grey lighten-1" >
            <router-view></router-view>
        </v-container>
        <app-footer></app-footer>
    </div>
</template>

<script>

    import Toolbar from "./Toolbar";
    import AppFooter from "./AppFooter";
    import Login from "./Login/Login";

    export default {
        components:{
            Toolbar,
            AppFooter,
            Login
        }
    }
</script>
