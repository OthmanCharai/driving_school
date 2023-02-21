<script setup>
import { useExamStore } from "@/stores/exam";
import { useTimerStore } from "@/stores/timer";
import { storeToRefs } from "pinia";

const { endExam } = useExamStore();
const { currentQuestionIndex } = storeToRefs(useExamStore());
const { timeLeft } = storeToRefs(useTimerStore());
</script>

<template lang="">
    <div class="exam-nav">
        <nav class="navbar bg-primary">
            <div class="container-fluid">
                <button
                    @click="endExam"
                    class="btn btn-secondary p-3"
                    id="end_quiz"
                    type="submit"
                >
                    إنهاء الاختبار
                </button>
                <button
                    v-if="currentQuestionIndex !== -1"
                    class="btn btn-secondary p-2 text-end mx-5 text-center"
                    type="button"
                >
                    الوقت المتبقي
                    <span class="bg-primary mx-1 p-1" id="timer">{{
                        timeLeft
                    }}</span>
                </button>
            </div>
        </nav>
    </div>
</template>
