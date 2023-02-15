<template lang="">
    <div id="wrap" class="wide">
        <top-bar></top-bar>
        <!--======= HEADER =========-->
        <LandingHeader />
        <subBanner
            :title="$t('words.landing.home')"
            :path="$t('words.landing.exams')"
        >
        </subBanner>

        <div class="content">
            <!--======= INTRESTED =========-->
            <section class="courses">
                <div class="container">
                    <!--======= TITTLE =========-->
                    <div class="tittle">
                        <h3>{{ $t("words.landing.exams") }}</h3>
                        <p>
                            Lessons From just $20 Per Hour or 5 Lessons for $120
                            or 10 Hours For $180
                        </p>
                        <hr />
                    </div>
                  


                    <!--======= RODUCTS =========-->
                    <section class="products">
                        <!--======= PRODUCTS ROW =========-->

                        <ul class="row">
                            <!--======= ITEM 1 =========-->
                            <exam-card
                                v-for="exam in exams.data"
                                :exam="exam"
                                :users_count="(exam.users_count==null)?0:exam.users_count"
                            >
                            </exam-card>
                        </ul>
                    </section>

                    <!--======= MONTH TITTLE =========-->
                    <div class="big-month"></div>

                    <!--======= PAGINATION =========-->
                    <ul class="pagination">
                        <li>
                            <a href="#."><i class="fa fa-chevron-left"></i></a>
                        </li>
                        <li><a href="#.">1</a></li>
                        <li><a href="#.">2</a></li>
                        <li><a href="#.">3</a></li>
                        <li><a href="#.">4</a></li>
                        <li>
                            <a href="#."><i class="fa fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </section>

            <FooterVue></FooterVue>
        </div>
    </div>
</template>
<script setup>
import LandingHeader from "./../../Components/Landing/header.vue";
import banner from "./../../Components/Landing/banner.vue";
import content from "./../../Components/Landing/content.vue";
import FooterVue from "./../../Components/Landing/footer.vue";
import subBanner from "./../../Components/Landing/sub-banner.vue";
import examCard from "./../../Components/exams/exam-card.vue";
import useExam from "./../../composables/exams";
import { onMounted } from "vue";

const { getExams, exams } = useExam();

onMounted(() => {
    getExams();
    
});
</script>
<style lang=""></style>
