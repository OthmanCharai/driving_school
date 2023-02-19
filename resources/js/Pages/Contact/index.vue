<template lang="">
    <top-bar></top-bar>
    <!--======= HEADER =========-->
    <LandingHeader />
    <subBanner
        :title="$t('words.landing.home')"
        :path="$t('words.contact.contact')"
    >
    </subBanner>
    <div class="content">
        <!--======= CONTACT =========-->
        <section class="contact">
            <!--======= MAP =========-->
            <div class="container">
                <!--======= CONTACT INFORMATION =========-->
                <div class="contact-info">
                    <div class="row">
                        <!--======= CONTACT FORM =========-->
                        <div class="col-md-8">
                            <h3>{{ $t("words.contact.get-in-touch") }}</h3>
                            <p class="margin-b-40">
                                {{ $t("words.contact.contact-words") }}
                            </p>
                            <div
                                v-show="false"
                                id="contact_message"
                                class="success-msg"
                            >
                                <i class="fa fa-paper-plane-o"></i>
                                {{ $t("words.contact.message") }}
                            </div>

                            <form
                                id="contact_form"
                                method="post"
                                @submit.prevent="contactSubmit"
                            >
                                <ul class="row">
                                    <li class="col-md-6">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            placeholder="Name"
                                            data-toggle="tooltip"
                                            v-model="contactForm.name"
                                            title="Name is required"
                                        />
                                    </li>
                                    <li class="col-md-6">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="contactForm.email"
                                            id="email"
                                            placeholder="Email"
                                            data-toggle="tooltip"
                                            title="Email is required"
                                        />
                                    </li>

                                    <li class="col-md-12">
                                        <textarea
                                            class="form-control"
                                            v-model="contactForm.message"
                                            id="message"
                                            rows="5"
                                            placeholder="Message"
                                            data-toggle="tooltip"
                                            title="Message is required"
                                        ></textarea>
                                    </li>
                                    <li>
                                        <button class="btn">
                                            {{
                                                $t("words.contact.send-message")
                                            }}
                                        </button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <!--======= CONTACT =========-->
                        <div class="col-md-4">
                            <h3>{{ $t("words.contact.contact-info") }}</h3>
                            <p
                                v-show="success"
                                class="alert alert-success margin-b-40"
                            >
                                {{ $t("words.contact.message") }}
                            </p>
                            <ul class="con-det">
                                <!--======= ADDRESS =========-->
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <h6>{{ $t("words.contact.address") }}</h6>
                                    <p>
                                        121 King St, Melbourne VIC 3000,<br />
                                        Australia
                                    </p>
                                </li>

                                <!--======= EMAIL =========-->
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <h6>{{ $t("words.landing.email") }}</h6>
                                    <p>name@site.com</p>
                                </li>

                                <!--======= ADDRESS =========-->
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <h6>our phone</h6>
                                    <p>(123) 45678 964</p>
                                </li>
                            </ul>

                            <!--======= SOCIAL ICON =========-->
                            <ul class="social_icons">
                                <li class="facebook">
                                    <a href="#."
                                        ><i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="twitter">
                                    <a href="#."
                                        ><i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="linkedin">
                                    <a href="#."
                                        ><i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li class="googleplus">
                                    <a href="#."
                                        ><i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="dribbble">
                                    <a href="#."
                                        ><i class="fa fa-dribbble"></i>
                                    </a>
                                </li>
                                <li class="skype">
                                    <a href="#."
                                        ><i class="fa fa-skype"></i>
                                    </a>
                                </li>
                                <li class="behance">
                                    <a href="#."
                                        ><i class="fa fa-behance"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--======= QUOTE =========-->
        <section class="quote-sim">
            <div class="container">
                <h3 class="pull-left">
                    Are You Looking For A Driving School In Manhattan/NYC
                </h3>
                <!--======= GET A QUOTE BUTTOn =========-->
                <a class="pull-right btn margin-t-20" href="#.">GET A QUOTE</a>
            </div>
        </section>
        <!--======= FOOTER =========-->
        <LandingFooter></LandingFooter>
    </div>
</template>
<script setup>
import { reactive, ref } from "vue";
import LandingHeader from "./../../Components/Landing/header.vue";
import topBar from "./../../Components/Landing/top-bar.vue";
import subBanner from "./../../Components/Landing/sub-banner.vue";
import LandingFooter from "./../../Components/Landing/footer.vue";
import axios from "axios";
import { onMounted } from "vue";

const contactForm = reactive({
    email: "",
    name: "",
    message: "",
});

const success = ref("false");

onMounted(() => {
    success.value = false;
    console.log(success);
});

const contactSubmit = () => {
    axios
        .post("api/contact", contactForm)
        .then((response) => {
            alert(response);
        })
        .catch((error) => {
            success.value = response.data.status;
        });
};
</script>
<style lang=""></style>
