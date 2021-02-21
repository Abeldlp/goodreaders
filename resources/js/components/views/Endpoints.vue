<template>
    <div>
        <h2>Api endpoints</h2>
        <p>Books</p>
        <ul>
            <li><strong>/api/books</strong>  [GET] Gets the list of books with its ratings </li>
            <li><strong>/api/books</strong>  [POST] Creates a new book [User needs to be logged in to create a book]</li>
            <ul>
                <li>title : String | required</li>
                <li>description : String (nullable)</li>
                <li>image : Image | required</li>
                <li>genre : String | required</li>
                <li>buy_link : String</li>
            </ul>
            <li><strong>/api/books/:id</strong>  [GET] Gets selected book with ratings and replies </li>
            <li><strong>/api/books/:id</strong>  [PUT] Changes specific book information </li>
            <ul>
                <li>title : String | required</li>
                <li>description : String (nullable)</li>
                <li>image : Image | required</li>
                <li>genre : String | required</li>
                <li>buy_link : String</li>
            </ul>
            <li><strong>/api/books/:id</strong>  [DELETE] Delete specific book </li>
        </ul>
        <p>Ratings</p>
        <ul>
            <li><strong>/api/rating/</strong>  [POST] Create a new rating [User needs to be logged in to rate the book]</li>
            <ul>
                <li>book_id : Number | required</li>
                <li>score : Number | required</li>
                <li>comment : String (nullable)</li>
            </ul>
            <li><strong>/api/rating/:id</strong>  [PUT] Update a specific rating [User can only change his own ratings]</li>
            <ul>
                <li>book_id : Number | required</li>
                <li>score : Number | required</li>
                <li>comment : String (nullable)</li>
            </ul>
            <li><strong>/api/rating/:id</strong>  [DELETE] Delete specific rating </li>
        </ul>
        <p>Replies</p>
        <ul>
            <li><strong>/api/reply/</strong>  [POST] Create a new reply [User needs to be logged in to reply to a comment]</li>
            <ul>
                <li>rating_id : Number | required</li>
                <li>reply : String | required</li>
            </ul>
            <li><strong>/api/reply/:id</strong>  [PUT] Update a specific reply [User can only change his own replies]</li>
            <ul>
                <li>rating_id : Number | required</li>
                <li>reply : String | required</li>
            </ul>
            <li><strong>/api/reply/:id</strong>  [DELETE] Delete specific reply </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Endpoints"
}
</script>

<style scoped>

</style>
