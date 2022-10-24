<template>
    <div>
        <div class="">
            <h2 class="my-5">Category Create</h2>
            <v-form @submit.prevent="submit">
                <v-text-field v-model="form.name" label="Title" type="text"></v-text-field>

                <v-btn v-if="editSlug" color="#90CA09" type="submit">
                    Update
                </v-btn>
                <v-btn v-else color="#90CAF9" type="submit">
                    Create
                </v-btn>

            </v-form>
        </div>
        <div class="">
            <v-card class="my-3">
                <v-toolbar color="#37474F" dark dense>

                    <v-toolbar-title>Inbox</v-toolbar-title>

                    <v-spacer></v-spacer>

                </v-toolbar>

                <v-list v-if="categories">
                    <!-- <template> -->
                    <v-list-item v-for="(category,index) in categories" :key="category.id">

                        <div class="mr-1">
                            <v-btn small color="orange" @click="edit(index)" text>Edit</v-btn>
                        </div>
                        <v-list-item-content>
                            <v-list-item-title>{{ category.name }}</v-list-item-title>
                        </v-list-item-content>
                        <v-btn small color="red" @click="destroy(category.slug,index)" text>Delete</v-btn>

                    </v-list-item>
                    <!-- </template> -->
                </v-list>


            </v-card>
        </div>

    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            // index:0,
            form: {
                name: null,
                // slug: null,
            },
            categories: {},
            editSlug: null,
        }
    },

    methods: {
        submit(){
            this.editSlug ? this.update() : this.create()
        },
        create() {
            // console.log(this.form);
            axios.post("/api/category/", this.form)
                .then(response => {
                    this.categories.unshift(response.data);
                    console.log("create", response.data)
                    this.form = {};
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
        update() {
            // console.log("work-->",this.editSlug)
            axios.patch(`/api/category/${this.editSlug}`,this.form)
                .then(response => {
                        this.categories.unshift(response.data);
                        this.form.name = null;
                        // console.log("update", response.data)
                    })
                .catch(error => console.log(error.response.data))
        },
        destroy(slug, index) {
            console.log(slug, index)
            axios.delete(`/api/category/${slug}`)
                .then(response => {
                    this.categories.splice(index, 1)
                    // console.log("del", response.data);
                })
                .catch(error => {
                    console.log(error.response.data)
                });
        },
        edit(index) {
           this.form.name = this.categories[index].name;
           this.editSlug = this.categories[index].slug;
           this.categories.splice(index,1);
            //   console.log(this.form.name)
            //   console.log(this.editSlug)
        },
        getCategoryData(){
            axios.get("/api/category/")
            .then(response => {
                // console.log(response.data.data)
                this.categories = response.data.data
                // let tt = this.categories.map((name,index) => {
                //     return this.categories[index].name;
                // });
                // console.log("tt",tt)
            })
            .catch(error => {
                console.log("Error -> ",error)
            });
        }
    },
    created() {
        if(!User.admin()){
            this.$router.push('/forum')
        }
       this.getCategoryData();
    },

}
</script>

<style lang="scss" scoped>

</style>