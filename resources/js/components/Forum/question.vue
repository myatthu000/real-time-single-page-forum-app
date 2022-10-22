<template>
  <v-card class="mb-3">
    <v-card-title>
      <router-link :to="data.path">
        {{ data.title }}
      </router-link>
    </v-card-title>

    <v-card-subtitle class="pb-3">
      <strong>
        {{ data.user }}
      </strong>
         said
      {{ data.created_at }}
    </v-card-subtitle>

    <v-card-text class="text--primary">
      <div v-html="body">
<!--        {{ data.body }}-->
      </div>
    </v-card-text>

  </v-card>
</template>

<script>
    import { marked } from 'marked';

    export default {
        props:["data"],
        computed: {
            body() {
                return marked.parse(this.data.body);
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
