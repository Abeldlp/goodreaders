<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-2">
                <router-link :to="{ name: 'createbook' }">
                    <button>Add a book</button>
                </router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-4 book-list " v-for="book in books" :key="book.id">
                <h5>{{ book.title }}</h5>
                <p>{{ book.author }}</p>
                <p>Posted by {{ book.user.name }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Home",
    components: {},
    created() {
        axios.get("/api/books")
        .then(res => (this.books = res.data))
        .catch(err => console.log(err))
    },
    data() {
        return {
            books: Array
        };
    }
};
</script>

<style scoped>
.book-list {
    width: 300px;
    height: 300px;
    background-color: pink;
}
</style>
