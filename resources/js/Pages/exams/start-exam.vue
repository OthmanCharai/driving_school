<template lang="">
    <div class="exam-page h-screen overflow-hidden">
        <exam-nav-barre></exam-nav-barre>
        <!-- Main content -->
        <div class="px-[20rem] py-32 overflow-hidden h-[100rem]">
            <sub-exam :exam="currentSubExam" :examIndex="currentSubExamIndex" />
        </div>
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
import { useExamStore } from "@/stores/exam";
import { storeToRefs } from "pinia";

const { exam, getExam } = useExam();

const { subExams, currentSubExam, currentSubExamIndex } = storeToRefs(
    useExamStore()
);

const route = useRoute();
onMounted(async () => {
    await getExam(route.params.id);
    const subExamsList = exam.value.sub_exams;
    subExams.value = subExamsList;
});
</script>
