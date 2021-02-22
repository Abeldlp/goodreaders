<template>
    <div>
        <h1 >Good Readers</h1>
        <div class="nav">
            <router-link :to="{ name: 'main' }">Home</router-link> 
            
            <router-link :to="{ name: 'endpoints' }">Endpoints</router-link> |
        </div>
        <div v-if="!authUser" class="login-section" >
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        </div>
        <div v-else  class="logout-section">
            <p class="user-name">{{ authUser.name}}</p>
            <a class="logOut" href="/logout"
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
<style>
*{
    padding: 0%;
    margin: 0%;
    box-sizing: border-box;
}

h1 {
    display: flex;
    justify-content: center;
}
.logout-section {
    display: flex;
    justify-content: flex-end;

}



</style>