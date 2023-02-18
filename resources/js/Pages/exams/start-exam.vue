<template lang="">
    <div class="exam-page">
        <exam-nav-barre></exam-nav-barre>
        <!-- Main content -->
        <main class="container mx-auto px-4 py-32   ">
            <div class="big-month "></div>
            <hr class="w-full" />
            <div class="mt-3 text-end"><p>Part 1</p></div>
        </main>
    </div>
    <exam-footer></exam-footer>
</template>
<script setup>
import ExamNavBarre from "./../../Components/exams/nav-bar.vue";
import ExamFooter from "./../../Components/exams/footer.vue";
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import useExam from "./../../composables/exams";
const { exam, getExam } = useExam();

const route = useRoute();
onMounted(async () => {
    await getExam(route.params.id);
});
</script>
<style></style>
