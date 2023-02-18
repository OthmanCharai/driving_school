<script setup>
import { ref } from "vue";

const props = defineProps(["exam", "examIndex"]);

const isSubExamStarted = ref(false);
const currentQuestion = ref(null);
</script>

<template>
    <div class="big-month">{{ exam?.name }}</div>
    <hr class="w-full" />
    <div class="mt-3 text-end">part {{ examIndex }}</div>
</template>
