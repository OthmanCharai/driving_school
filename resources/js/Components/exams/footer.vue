<script setup>
import { useExamStore } from "@/stores/exam";

const { showNextQuestion } = useExamStore();
</script>
<template lang="">
    <footer class="question w-full h-36 fixed bottom-0 flex items-end">
        <div class="flex">
            <button @click="showNextQuestion" class="btn btn-secondary w-full">
                {{ $t("words.landing.next-question") }}
            </button>
        </div>
    </footer>
</template>
