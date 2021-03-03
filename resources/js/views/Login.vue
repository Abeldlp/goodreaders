<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="row justify-content-center">Login</h3>

                <form action="">
                    <div>
                        <label for="email" class="form-label">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            class="form-control"
                            placeholder="example@mail.com"
                            v-model="username"
                            required
                        />
                    </div>

                    <div>
                        <label for="password" class="form-label"
                            >Password</label
                        >
                        <input
                            type="password"
                            id="password"
                            class="form-control"
                            v-model="password"
                            required
                        />
                    </div>

                    <div>
                        <input type="checkbox" id="check" />
                        <label for="check">Remember Me</label>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: null,
            password: null
        };
    }
};
</script>

<style scoped>
.container {
    border-radius: 5px;
}
</style>
