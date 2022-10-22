<template>
    <div>

    </div>
</template>

<script>
import User from '../Helpers/User';

    export default {
        created () {
            EventBus.$emit("logout");
        },
    }
</script>
