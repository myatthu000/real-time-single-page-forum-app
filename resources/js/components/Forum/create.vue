<template>
    <div>
        <h3>Create</h3>
        <v-container>
            <v-form @submit.prevent="create">
                <span class="red--text" v-if="errors.title">
                    <!-- {{ this.errors.title[0] }} -->
                    Please Enter Title</span>
                <v-text-field v-model="form.title" label="Title" type="text"></v-text-field>

                <span class="red--text" v-if="errors.category_id">Please Choose Category</span>
                <v-select :items="categories" v-model="form.category_id" item-text="name" item-value="id"
                    label="Category" autoComplete></v-select>

                <!-- <v-text-field v-model="form.body" label="Description" type="text"></v-text-field> -->

                <span class="red--text" v-if="errors.body">Please Enter Description</span>
                <vue-editor label="Description" class="mb-3" v-model="form.body"></vue-editor>

                <v-btn 
                :disabled="disabled"
                color="#90CAF9" type="submit">
                    Create
                </v-btn>

            </v-form>
        </v-container>
    </div>
</template>

<script>
import axios from 'axios';
import { VueEditor } from "vue2-editor";

export default {
    data() {
        return {
            form: {
                title: null,
                category_id: null,
                body: null,
            },
            categories: {},
            errors: {}
        }
    },
    components: {
        VueEditor
    },
    created() {
        axios.get("/api/category")
            .then(response => {
                this.categories = response.data.data;
                // console.log(this.categories)
            })
            .catch(error => console.log(error.data.data));
    },
    computed: {
        disabled() {
            return !(this.form.title && this.form.body && this.form.category_id)
        }
    },
    methods: {
        create() {
            console.log(this.form)
            axios.post("/api/question", this.form)
                .then(response => {

                    console.log(response.data.path);

                    this.form = {
                        title: null,
                        category_id: null,
                        body: null
                    };

                    this.$router.push(response.data.path)

                })
                .catch(error => {
                    // console.log(error.response.data);
                    // console.log(this.errors);
                    this.errors = error.response.data.errors;
                });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>