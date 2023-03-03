<template lang="">
    <div class="drive-form">
        <div class="intres-lesson">
            <!--======= FORM =========-->
            <form
                role="form"
                id="find_course"
                method="post"
                class=""
                @submit.prevent="login"
            >
                <ul class="row">
                    <!--======= INPUT EMAIL =========-->
                    <li class="col-sm-12">
                        <div class="form-group">
                            <input
                                type="email"
                                v-model="email"
                                class="form-control"
                                id="email"
                                placeholder="Your Email"
                            />
                            <span class="fa fa-envelope"></span>
                        </div>
                    </li>

                    <!--======= INPUT PHONE NUMBER =========-->
                    <li class="col-sm-12">
                        <div class="form-group">
                            <input
                                type="password"
                                v-model="password"
                                class="form-control"
                                id="password"
                                placeholder="password"
                            />
                            <span class="fa fa-password"></span>
                        </div>
                    </li>
                </ul>
                <!--======= BUTTON =========-->
                <div class="text-center d-flex justify-content-around">
                    <button @click="registerUser" class="btn">
                        {{ $t("words.landing.login") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { ref, reactive } from "vue";

const email = ref("email");
const password = ref("password");

const user = reactive({
    name: "",
    email: "",
});
const login = async () => {
    const response = await axios.post("api/login", {
        email: email.value,
        password: password.value,
    });
    if (response.data) {
        user.name = response.data.name;
        user.email = response.data.email;
        localStorage.setItem("loggedIn", JSON.stringify(response.data.token));
        console.log(localStorage.getItem("loggedIn"));
    }
};
</script>
<style></style>
