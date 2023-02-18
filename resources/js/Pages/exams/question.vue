<template lang="">
    <exam-nav-barre></exam-nav-barre>

    <main class="container mx-auto py-32">
        <div class="row">
            <div class="col-md-6">
                <img
                    src="https://tailwindcss.com/_next/static/media/social-card-large.a6e71726.jpg"
                    class=""
                    alt="Image"
                />
            </div>
            <div class="col-md-6 mr-44 mt-20 h-40 w-full ml-10">
                <div class="row question rounded-lg h-32 mt-2"></div>
                <div v-for="item in data">
                    <ExamOption :value="item" :key="item"/>
                </div>
            </div>
        </div>
    </main>

    <exam-footer></exam-footer>
</template>
<script setup>
import ExamNavBarre from "./../../Components/exams/nav-bar.vue";
import ExamFooter from "./../../Components/exams/footer.vue";
import ExamOption from "./../../Components/exams/option.vue";
const data = ["1", "2", "3", "4"];
</script>
<style>
.my-border {
    border-color: var(--primary) !important;
}
:root {
    --tw-custom-blue: #112d4e;
}
.question {
    background-color: var(--tw-custom-blue);
}
</style>
