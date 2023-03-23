<script setup>
import { useExamStore } from "@/stores/exam";
import Question from "./question.vue";
import CustomShit from "./../../Components/exams/CustomShit.vue";
import ImagesQuestion from "./ImagesQuestion.vue";
import { storeToRefs } from "pinia";

const props = defineProps(["exam", "examIndex"]);

const {
    currentSubExam,
    currentQuestionIndex,
    currentQuestion,
    currentSubExamIndex,
} = storeToRefs(useExamStore());
// TODO
</script>

<template>
    <template v-if="currentQuestionIndex === -1">
        <div class="big-month">{{ currentSubExam?.name }}</div>
        <hr class="w-full" />
        <div class="mt-3 text-end">part {{ currentSubExamIndex }}</div>
    </template>
    <template v-else>
        <ImagesQuestion v-if="true"/>
        <custom-shit v-else-if="currentQuestion.dropzones.length" :question="currentQuestion" />
        <Question v-else :question="currentQuestion" />
    </template>
</template>
