<script setup>
import { ref } from "vue";
import { useExamStore } from "@/stores/exam";
import Question from "./question.vue";
import { storeToRefs } from "pinia";

const props = defineProps(["exam", "examIndex"]);

const {
    currentExam,
    currentQuestionIndex,
    currentQuestion,
    currentSubExamIndex,
} = storeToRefs(useExamStore());
</script>

<template>
    <template v-if="currentQuestionIndex === -1">
        <div class="big-month">{{ currentExam?.name }}</div>
        <hr class="w-full" />
        <div class="mt-3 text-end">part {{ currentSubExamIndex }}</div>
    </template>
    <template v-else><Question :question="currentQuestion" /> </template>
</template>
