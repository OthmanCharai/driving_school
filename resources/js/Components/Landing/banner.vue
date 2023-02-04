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
                                    <h5>
                                        Find Driving Course
                                        <i class="fa fa-road"></i>
                                    </h5>
                                    <div v-show="login" class="drive-form">
                                        <div class="intres-lesson">
                                            <!--======= FORM =========-->
                                            <form
                                                role="form"
                                                id="find_course"
                                                method="post"
                                                class=""
                                            >
                                                <ul class="row">
                                                    <!--======= INPUT NAME =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="name"
                                                                name="Name"
                                                                placeholder="Your Name"
                                                            />
                                                            <span
                                                                class="fa fa-user"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT EMAIL =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="email"
                                                                class="form-control"
                                                                id="email"
                                                                placeholder="Your Email"
                                                            />
                                                            <span
                                                                class="fa fa-envelope"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT PHONE NUMBER =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="phone"
                                                                placeholder="Phone"
                                                            />
                                                            <span
                                                                class="fa fa-phone"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT PHONE NUMBER =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                name="datepicker"
                                                                class="form-control"
                                                                id="datepicker"
                                                                placeholder="DD/MM/YY"
                                                            />
                                                            <span
                                                                class="fa fa-calendar"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select1"
                                                            >
                                                                <option>
                                                                    Course Type
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    1
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    2
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-file-text-o"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select2"
                                                            >
                                                                <option>
                                                                    Car Type
                                                                </option>
                                                                <option>
                                                                    Car Type 1
                                                                </option>
                                                                <option>
                                                                    Car Type 2
                                                                </option>
                                                                <option>
                                                                    Car Type 3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-car"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select3"
                                                            >
                                                                <option>
                                                                    Time
                                                                </option>
                                                                <option>
                                                                    Time 1
                                                                </option>
                                                                <option>
                                                                    Time 2
                                                                </option>
                                                                <option>
                                                                    Time 3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-clock-o"
                                                            ></span>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <!--======= BUTTON =========-->
                                                <div
                                                    class="col-md-12 d-flex justify-content-around"
                                                >
                                                    <div class="col-md-6 mx-2">
                                                        <button
                                                            @click="loginUser"
                                                            class="btn text-center my-2"
                                                        >
                                                            {{
                                                                $t(
                                                                    "words.landing.login"
                                                                )
                                                            }}
                                                        </button>
                                                    </div>

                                                    <div class="col-md-6 mx-2">
                                                        <a
                                                            class="btn text-center mb-2"
                                                            @click="toggleLogin"
                                                        >
                                                            {{
                                                                $t(
                                                                    "words.landing.register"
                                                                )
                                                            }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div v-show="!login" class="drive-form">
                                        <div class="intres-lesson">
                                            <!--======= FORM =========-->
                                            <form
                                                role="form"
                                                id="find_course"
                                                method="post"
                                            >
                                                <ul class="row">
                                                    <!--======= INPUT NAME =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="name"
                                                                name="Name"
                                                                placeholder="Your Name"
                                                            />
                                                            <span
                                                                class="fa fa-user"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT EMAIL =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="email"
                                                                placeholder="Your aaaaaaaaaaaaaaaaaaaaaa"
                                                            />
                                                            <span
                                                                class="fa fa-envelope"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT PHONE NUMBER =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="phone"
                                                                placeholder="Phone"
                                                            />
                                                            <span
                                                                class="fa fa-phone"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT PHONE NUMBER =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                name="datepicker"
                                                                class="form-control"
                                                                id="datepicker"
                                                                placeholder="DD/MM/YY"
                                                            />
                                                            <span
                                                                class="fa fa-calendar"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select1"
                                                            >
                                                                <option>
                                                                    Course Type
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    1
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    2
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-file-text-o"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select2"
                                                            >
                                                                <option>
                                                                    Car Type
                                                                </option>
                                                                <option>
                                                                    Car Type 1
                                                                </option>
                                                                <option>
                                                                    Car Type 2
                                                                </option>
                                                                <option>
                                                                    Car Type 3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-car"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select3"
                                                            >
                                                                <option>
                                                                    Time
                                                                </option>
                                                                <option>
                                                                    Time 1
                                                                </option>
                                                                <option>
                                                                    Time 2
                                                                </option>
                                                                <option>
                                                                    Time 3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-clock-o"
                                                            ></span>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <!--======= BUTTON =========-->
                                                <div
                                                    class="text-center d-flex justify-content-around"
                                                >
                                                    <button
                                                        @click="registerUser"
                                                        class="btn"
                                                    >
                                                        {{
                                                            $t(
                                                                "words.landing.register"
                                                            )
                                                        }}
                                                    </button>
                                                    <a
                                                        class="btn"
                                                        @click="toggleLogin"
                                                    >
                                                        {{
                                                            $t(
                                                                "words.landing.login"
                                                            )
                                                        }}
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
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
import { ref } from "vue";
let login = ref(true);
const toggleLogin = () => {
    login = !login;
};
</script>
<style lang=""></style>
