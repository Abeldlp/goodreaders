<template>
    <div class="main">
        <div class="nav-bar">
            <h1>Good Readers</h1>

            <div>
                <div v-if="!authUser" class="login-section">
                    <a href="/login">Login</a> |
                    <a href="/register">Register</a>
                </div>

                <div v-else class="logout-section">
                    <p class="user-name">{{ authUser.name }}</p>
                    |
                    <a
                        class="logOut"
                        href="/logout"
                        onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"
                    >
                        Log out
                    </a>
                    <form
                        id="logout-form"
                        action="/logout"
                        method="POST"
                        class="d-none"
                    >
                        <input type="hidden" name="_token" :value="csrf" />
                    </form>
                </div>
            </div>
        </div>

        <div class="router-link">
            <router-link :to="{ name: 'main' }">Home</router-link>
            |
            <router-link :to="{ name: 'endpoints' }">Endpoints</router-link> |
            <router-link :to="{ name: 'login' }">Login</router-link>
        </div>
        <div class="container">
            <router-view :authUser="authUser"></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "App",
    props: {
        authUser: ""
    },
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    }
};
</script>
<style>
* {
    padding: 0%;
    margin: 0%;
    box-sizing: border-box;
}

body {
    color: #2c3e50;
    width: 100%;
    min-height: 100vh;
}

.nav-bar {
    display: flex;
    justify-content: space-around;
}

.login-section {
    padding-top: 15px;
}

.logout-section {
    display: flex;
    padding-top: 15px;
}
</style>
