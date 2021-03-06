<template>
    <div>
        <h2>book details</h2>
        <img style="height: 200px" :src="`/storage/${book.image}`" />
        <p>{{ book.title }}</p>
        <p>{{ book.author }}</p>
        <p>{{ book.description }}</p>
        <p>{{ book.genre }}</p>
        <p>{{ book.buy_link }}</p>
        <button v-show="this.authUser" @click="deleteData">Delete</button>

        <p>Rating:</p>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {
        id: Number,
        authUser: ""
    },
    data() {
        return {
            book: Object,
            ratings: Array
        };
    },
    created() {
        axios
            .get("/api/books/" + this.id)
            .then(res => {
                this.book = res.data.book;
                this.ratings = res.data.ratings;
            })
            .catch(err => console.log(err));
    },
    methods: {
        deleteData() {
            axios
                .delete("/api/books/" + this.id)
                //.then(res => (this.book = res.data))
                //.then(alert("This book is deleted."))
                .then(this.$router.push({ name: "main" }))
                .catch(err => console.log(err));
        }
    }
};
</script>

<style></style>
