<template>
    <div>
        <Toolbar></Toolbar>
        <div class="my-2" >
            <router-view></router-view>
        </div>
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
