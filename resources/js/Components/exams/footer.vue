<script setup>
import { useExamStore } from "@/stores/exam";

const { showNextQuestion } = useExamStore();

const next = () => {
    showNextQuestion();
    next();
}
</script>
<template lang="">
    <footer class="question w-full fixed bottom-0 flex items-center justify-centerd h-32 ">
        <div class="mb-10 mr-20">
            <button @click="showNextQuestion" class="btn btn-secondary w-full mb-10 mr-20">
                {{ $t("words.landing.next-question") }}
            </button>
        </div>
    </footer>
</template>
