<template>
    <div>
        <div class="book-details">
            <h2>book details</h2>
            <img style="height: 200px" :src="`/storage/${book.image}`" />
            <p>Title: {{ book.title }}</p>
            <p>Author: {{ book.author }}</p>
            <p>Description: {{ book.description }}</p>
            <p>Genre: {{ book.genre }}</p>
            <p>Created at: {{ book.created_at }}</p>
            <button v-show="this.authUser" @click="deleteData">Delete</button>

            <router-link :to="{ name: 'editdetails', params: { id: book.id } }">
                <button v-show="this.authUser">Edit</button>
            </router-link>

            <a :href="book.buy_link">Click to buy </a>
        </div>

        <div class="reviews-part">
            <button @click="makeReview">Make a Review</button>
            <CreateRating v-show="seen" :id="id" />
        </div>

        <div class="showReview">
            <div v-for="rating in ratings">
                <p>{{ rating.user.name }}</p>
                <p>{{ rating.score }}</p>
                <p>{{ rating.comment }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import CreateRating from "../components/CreateRating.vue";
export default {
    components: { CreateRating },
    props: {
        id: "",
        authUser: ""
    },
    data() {
        return {
            book: Object,
            ratings: Array,
            seen: false
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
                .then(this.$router.push({ name: "main" }))
                .catch(err => console.log(err));
        },
        makeReview() {
            if (this.authUser) {
                this.seen = true;
            } else {
                this.$router.push({ name: "login" });
            }
        }
    }
};
</script>

<style></style>
