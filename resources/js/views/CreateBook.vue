<template>
    <div class="row justify-content-center">
        <div class="col-9">
            <form @submit.prevent="submit">
                <h3>Add new book</h3>
                <div v-if="errors" class="mb-3">
                    <!--<b>Please correct the following error(s):</b>-->
                    <ul>
                        <li v-for="error in errors.genre">{{ error }}</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input
                        class="form-control"
                        type="text"
                        v-model="form.title"
                        placeholder="Harry Potter"
                    />
                </div>

                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input
                        class="form-control"
                        type="text"
                        v-model="form.author"
                        placeholder=" J. K. Rowling"
                    />
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input
                        class="form-control"
                        type="text"
                        v-model="form.genre"
                        placeholder="Fantasy-fiction"
                    />
                </div>

                <div class="mb-3">
                    <label class="form-label">Buy Link</label>
                    <input
                        class="form-control"
                        type="text"
                        v-model="form.buy_link"
                        placeholder="http://"
                    />
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea
                        class="form-control"
                        type="text"
                        v-model="form.description"
                        placeholder="Best book ever!"
                    />
                </div>

                <div>
                    <div class="custom-file">
                        <input
                            class="custom-file-input"
                            type="file"
                            id="file"
                            ref="file"
                            @change="handleFileUpload()"
                        />
                        <label class="custom-file-label" for="files"
                            >Choose file</label
                        >
                    </div>
                </div>
                <button class="btn btn-primary mb-3">
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Form",
    props: {
        authUser: ""
    },
    data() {
        return {
            errors: [],
            form: {
                title: "",
                description: "",
                genre: "",
                buy_link: "",
                author: "",
                user_id: this.authUser.id
            }
        };
    },
    mounted() {
        if (!this.authUser) {
            this.$router.push({ name: "login" });
        }
    },
    methods: {
        submit() {
            let formData = new FormData();
            formData.append("title", this.form.title);
            formData.append("description", this.form.description);
            formData.append("genre", this.form.genre);
            formData.append("buy_link", this.form.buy_link);
            formData.append("author", this.form.author);
            formData.append("image", this.file);
            formData.append("user_id", this.form.user_id);

            axios
                .post("/api/books/save", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => location.reload())
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        }
    }
};
</script>

<style scoped>
.container {
    width: 500px;
    max-width: 100%;
    overflow: hidden;
    background-color: white;
    border-radius: 5px;
}

h3 {
    margin-bottom: 20px;
    border-bottom: 1px solid salmon;
    text-align: center;
    padding-bottom: 10px;
}

button {
    margin-top: 10px;
    width: 100%;
}

form input {
    padding: 20px 0px;
}
</style>
