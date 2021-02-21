<template>
    <div>
        <h1 class="ml-3">Nav of the app goes here</h1>
        <p class="ml-5">
            <router-link :to="{ name: 'main' }">Main</router-link> |
            <router-link :to="{ name: 'test' }">Test</router-link> |
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
        props : {
            authUser : Object,
        },
        mounted() {
            console.log(this.authUser)
        }
    }
</script>
