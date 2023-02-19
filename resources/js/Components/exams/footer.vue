<script setup>
import { useExamStore } from "@/stores/exam";
import { storeToRefs } from "pinia";

const { showNextQuestion } = useExamStore();
const { currentQuestionIndex, currentSubExam } = storeToRefs(useExamStore());

const next = () => {
    showNextQuestion();
    next();
};
</script>
<template lang="">
    <footeEr
        class="question w-full fixed bottom-0 flex items-center justify-between h-32"
    >
        <div class="flex items-center justify-between w-full mt-10">
            <div class="mb-10">
                <button
                    @click="showNextQuestion"
                    class="btn btn-secondary w-full mb-10 mr-20"
                >
                    {{ $t("words.landing.next-question") }}
                </button>
            </div>
            <div
                v-if="currentQuestionIndex !== -1"
                class="text-white w-[33%] text-5xl mb-10 text-left"
            >
                {{ currentSubExam.questions.length }} /
                {{ currentQuestionIndex + 1 }}
                question
            </div>
            <div class="w-[33%]"></div>
        </div>
    </footeEr>
</template>
