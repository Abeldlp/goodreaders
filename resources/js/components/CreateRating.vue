<template>
    <div>
        <div class="rating-part">
            <form class="rating"></form>
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
            <button>Save</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "CreateRating",
    props: {
        authUser: "",
        id: ""
    },
    data() {
        return {
            comment: ""
        };
    }
};
</script>

<style></style>
