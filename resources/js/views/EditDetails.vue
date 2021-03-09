<template>
    <div class="row justify-content-center">
        <div class="col-9">
            <form @submit.prevent="saveData">
                <h3>Edit</h3>
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
                        type="url"
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
                <div class="button-style">
                    <button class="btn btn-primary ">
                        Save
                    </button>

                    <router-link :to="{ name: 'bookdetails' }">
                        <button class="btn btn-primary ">
                            Cancel
                        </button>
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Form",
    props: {
        authUser: "",
        id: ""
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
    created() {
        if (!this.authUser) {
            this.$router.push({ name: "login" });
        }
        axios
            .get("/api/books/" + this.id)
            .then(res => {
                this.form.title = res.data.book.title;
                this.form.description = res.data.book.description;
                this.form.genre = res.data.book.genre;
                this.form.buy_link = res.data.book.buy_link;
                this.form.author = res.data.book.author;
            })
            .catch(err => console.log(err));
    },
    methods: {
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
        saveData() {
            /*let formData = new FormData();
            formData.append("title", this.form.title);
            formData.append("description", this.form.description);
            formData.append("genre", this.form.genre);
            formData.append("buy_link", this.form.buy_link);
            formData.append("author", this.form.author);
            formData.append("image", this.file);
            formData.append("user_id", this.form.user_id);

            for (var i of formData.entries()) {
                console.log(i);
            }*/
            axios.put("/api/books/" + this.id, this.form);
            /*.then(res => console.log(Success))
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
}

.button-style {
    display: flex;
    justify-content: space-around;
}

form input {
    padding: 20px 0px;
}
</style>
