<template>
    <div>
        <form></form>
        <div v-for="book in books" :key="book.id">
            <h3>{{book.title}}</h3>
            <p>{{book.description}}</p>

        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Form from '../components/Form.vue';
export default {
    name: "Home",
    components: {
        Form
    },
    mounted(){
        axios.get('/api/books').then(res => this.books = res.data)
    },
    data(){
        return {
            books : Array
        }
    }
}
</script>

<style scoped>
    p{
        overflow: hidden;
    }
</style>
