<template>
    <div>
        <h3>Edit</h3>
        <v-container>
            <v-form @submit.prevent="update">
                <v-text-field v-model="form.title" label="Title" type="text"></v-text-field>

                <!-- <v-select :items="categories" v-model="form.category_id" item-text="name" item-value="id"
                    label="Category" autoComplete></v-select> -->

                <!-- <v-text-field v-model="form.body" label="Description" type="text"></v-text-field> -->

                <vue-editor label="Description" class="mb-3" v-model="form.body"></vue-editor>

                <div>
                    <v-btn color="#FFD600" type="submit">
                        Edit
                    </v-btn>
                    <v-btn color="" @click="cancel">
                        Cancel
                    </v-btn>
                </div>

            </v-form>
        </v-container>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                title: null,
                body: null,
                // category_id: null,
            },
        }
    },
    props: ["data"],
    components: {
        VueEditor
    },

    methods: {
        cancel() {
            EventBus.$emit("cancelEditing");
        },

        update() {
            axios.patch(`/api/question/${this.form.slug}`,this.form)
                .then(response => this.cancel())
                .catch(error => console.log(error.response.data))
        }
    },
    mounted() {
        this.form = this.data;
    },
}
</script>

<style lang="scss" scoped>

</style>