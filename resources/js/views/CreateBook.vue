<template>
    <div class="container">
        <form class="form"></form>
        <div>
            <h3>Add new book</h3>

            <div class="form-control">
                <label>Title : </label>
                <input type="text" v-model="form.title" placeholder="Title" />
            </div>

            <div class="form-control">
                <label>Genre : </label>
                <input type="text" v-model="form.genre" placeholder="Genre" />
            </div>

            <div class="form-control">
                <label>Buy Link : </label>
                <input
                    type="text"
                    v-model="form.buy_link"
                    placeholder="Buy Link"
                />
            </div>

            <div class="form-control">
                <label>Description : </label>
                <input
                    type="text"
                    v-model="form.description"
                    placeholder="Description"
                />
            </div>

            <button @click="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Form",
    data() {
        return {
            form: {
                title: "",
                description: "",
                genre: "",
                buy_link: "",
                image: "none",
                user_id: 1
            }
        };
    },
    methods: {
        submit() {
            axios.post("/api/books/save", this.form);
            /*.then(res => (res.data = this.form))
                .catch(err => console.log(err));*/
        }
    }
};
</script>

<style scoped>
.container {
    width: 500px;
    max-width: 100%;
    overflow: hidden;
    min-height: 100vh;
}

.form {
    padding: 30px 40px;
}

.form-control {
    margin-bottom: 10px;
    position: relative;
}
</style>
