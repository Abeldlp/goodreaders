<template>
    <div>
        <div class="rating-part">
            <star-rating
                v-model="score"
                :star-size="20"
                :increment="0.5"
            ></star-rating>
        </div>
        <div class="comment-part">
            <h5>What did you think?</h5>
            <form class="comment">
                <label for="comment"></label>
                <textarea
                    v-model="comment"
                    name="comment"
                    id="comment"
                    placeholder="What did you think?"
                ></textarea>
            </form>
            <button @click="saveReview">Save</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import StarRating from "vue-star-rating";

export default {
    name: "CreateRating",
    components: {
        StarRating
    },
    props: {
        authUser: "",
        id: ""
    },
    data() {
        return {
            comment: "",
            score: Number
        };
    },
    methods: {
        saveReview() {
            axios
                .post("/api/rating/", {
                    book_id: this.id,
                    comment: this.comment,
                    score: this.score
                })
                .then(alert("Sent Review"));
        }
    }
};
</script>

<style></style>
