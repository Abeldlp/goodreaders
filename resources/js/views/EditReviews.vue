<template>
    <div>
        <div class="edit-reviews">
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
                <button>Edit</button>
                <button>Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
import StarRating from "vue-star-rating";
export default {
    name: "EditReviews",
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
            score: 0,
            book_id: this.id
        };
    },
    created() {
        axios.get("/api/books/" + this.id).then(res => {
            console.log(res.data.ratings);
            // this.comment = res.data.ratings.comment;
            // this.score = res.data.ratings.score;
        });
        // .catch(err => console.log(err));
    }
};
</script>

<style></style>
