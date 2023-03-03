<script setup>
import { useExamStore } from "@/stores/exam";
import { storeToRefs } from "pinia";

const { showNextQuestion, showPreviousQuestion } = useExamStore();
const { currentQuestionIndex, currentSubExam } = storeToRefs(useExamStore());
</script>
<template>
    <footer
        class="left-0 question w-full fixed bottom-0 flex items-center justify-between h-10 px-10 py-20"
    >
        <div class="mt-12">
            <button @click="showNextQuestion" class="btn btn-secondary w-full">
                {{ $t("words.landing.next-question") }}
            </button>
        </div>
        <div
            v-if="currentQuestionIndex !== -1"
            class="text-white w-[33%] text-5xl text-left"
        >
            {{ currentSubExam.questions.length }} /
            {{ currentQuestionIndex + 1 }}
            question
        </div>
        <div class="w-[33%] mt-12">
            <button
                v-if="currentQuestionIndex > 0"
                @click="showPreviousQuestion"
                class="btn btn-secondary w-auto mb-10 mr-20"
            >
                {{ $t("words.landing.prev-question") }}
            </button>
        </div>
    </footer>
</template>
