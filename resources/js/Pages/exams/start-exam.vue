<template lang="">
    <div class="exam-page">
        <exam-nav-barre></exam-nav-barre>
        <!-- Main content -->
        <main class="container mx-auto px-4 py-32">
            <sub-exam :exam="currentSubExam" :examIndex="currentSubExamIndex" />
        </main>
    </div>
    <exam-footer></exam-footer>
</template>
<script setup>
import subExam from "./subExam.vue";
import ExamNavBarre from "./../../Components/exams/nav-bar.vue";
import ExamFooter from "./../../Components/exams/footer.vue";
import { onMounted } from "vue";
import { ref } from "vue";
import { useRoute } from "vue-router";
import useExam from "./../../composables/exams";
const { exam, getExam } = useExam();

let currentSubExam = ref(null);
let currentSubExamIndex = ref(1);

const route = useRoute();
onMounted(async () => {
    await getExam(route.params.id);
    // console.log();
    const subExams = exam.value.data.sub_exams.data;
    currentSubExam.value = subExams[0];
    console.log(currentSubExam.value);
});
</script>
<style></style>
