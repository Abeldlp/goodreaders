<template>
    <div>
        <h1 class="ml-3">Nav of the app goes here</h1>
        <p class="ml-5">
            <router-link :to="{ name: 'main' }">Main</router-link> |
            <router-link :to="{ name: 'test' }">Test</router-link> |
            <router-link :to="{ name: 'endpoints' }">Endpoints</router-link> |
        </p>
        <div v-if="!authUser" class="ml-5">
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        </div>
        <div v-else class="ml-5">
            <p>{{ authUser.name}}</p>
            <a href="/logout"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                logout
            </a>
            <form id="logout-form" action="/logout" method="POST" class="d-none">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>

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
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }
    }
</script>
