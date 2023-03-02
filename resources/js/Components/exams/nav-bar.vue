<script setup>
import { useExamStore } from "@/stores/exam";
import { useTimerStore } from "@/stores/timer";
import { storeToRefs } from "pinia";
import progressBar from "../common/progressBar.vue";

const { endExam } = useExamStore();
const { currentQuestionIndex } = storeToRefs(useExamStore());
const { timeLeft } = storeToRefs(useTimerStore());
</script>

<template lang="">
    <div class="exam-nav bg-primary py-8 flex justify-between px-12 relative">
        <div>
            <button
                v-if="currentQuestionIndex !== -1"
                class="btn btn-secondary p-2 text-end mx-5 text-center"
                type="button"
            >
                الوقت المتبقي
                <span class="bg-primary mx-1 p-1" id="timer">{{
                    Math.floor(timeLeft)
                }}</span>
            </button>
        </div>
        <button
            @click="endExam"
            class="btn btn-secondary p-3"
            id="end_quiz"
            type="submit"
        >
            إنهاء الاختبار
        </button>
        <progressBar
            v-if="currentQuestionIndex !== -1"
            class="!absolute w-full p-0 m-0 left-0 bottom-[-1rem]"
            :value="timeLeft"
            :max="8"
        />
    </div>
</template>
