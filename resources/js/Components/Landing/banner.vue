<template>
    <!--======= BANNER =========-->
    <div id="banner">
        <div class="">
            <ul class="">
                <!--======= SLIDE 1 =========-->
                <li>
                    <img
                        src="https://thumbs.dreamstime.com/b/car-road-whit-motion-blur-background-53052682.jpg"
                        class="fluid"
                        style="height: 830px"
                        alt=""
                    />
                    <div class="container">
                        <div class="text-slider">
                            <div class="col-sm-7">
                                <h3>
                                    Save Your MOney Book Your Lesson
                                    <i class="fa fa-long-arrow-left"></i>
                                </h3>
                                <p>
                                    Proin gravida nibh vel velit auctor aliquet.
                                    Aenean sollicitudin, lorem quis bibendum
                                    auctor.
                                </p>
                                <a class="btn" href="08_booking_page.html">{{
                                    $t("words.landing.test-exams")
                                }}</a>
                            </div>
                            <div class="col-sm-5 col-md-4 pull-left hidden-xs">
                                <div class="find-drive">
                                    <div class="tabs"></div>
                                    <ul
                                        class="tabs-nav d-flex justify-content-center"
                                    >
                                        <li>
                                            <a
                                                class="btn text-center mb-2"
                                                @click="selectedTab = 'login'"
                                                :class="{
                                                    'is-active':
                                                        selectedTab === 'login',
                                                }"
                                            >
                                                {{ $t("words.landing.login") }}
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="btn text-center mb-2"
                                                @click="
                                                    selectedTab = 'register'
                                                "
                                                :class="{
                                                    'is-active':
                                                        selectedTab ===
                                                        'register',
                                                }"
                                            >
                                                {{
                                                    $t("words.landing.register")
                                                }}
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tabs-content">
                                        <component
                                            :is="selectedTabComponent"
                                        ></component>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <!--======= SLIDE 2 =========-->
            </ul>
        </div>
    </div>
</template>
<script setup>
import { ref, computed } from "vue";

import Login from "./login.vue";
import Register from "./register.vue";

let selectedTab = ref("login");
const selectedTabComponent = computed(() => {
    switch (selectedTab.value) {
        case "login":
            return Login;
        case "register":
            return Register;
    }
});
</script>
<style scoped>

.tabs {
    display: flex;
    flex-direction: column;
}

.tabs-nav {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    justify-content: center;
}

.tabs-nav li {
    cursor: pointer;
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.tabs-nav li.is-active {
    background-color: #ddd;
}

.tabs-content {
    padding: 20px;
}
</style>
