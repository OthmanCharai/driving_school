<template lang="">
    <div class="flex h-[80%] gap-10 w-full">
        <div class="flex-1 mr-44 h-40 w-full ml-10">
            <div
                class="row question rounded-lg h-32 mt-2 text-white items-center justify-center"
            >
                {{ question.question }}
            </div>
            <div v-for="item in question.options">
                <ExamOption :value="item.answer" :key="item.id" />
            </div>
        </div>
        <div class="col-md-6">
            <img
                src="https://tailwindcss.com/_next/static/media/social-card-large.a6e71726.jpg"
                class="w-full h-full"
                alt="Image"
            />
        </div>
    </div>
</template>
<script setup>
import ExamOption from "./../../Components/exams/option.vue";

defineProps({
    question: {
        type: Object,
        required: true,
    },
});
</script>
<style>
.my-border {
    border-color: var(--primary) !important;
}
:root {
    --tw-custom-blue: #112d4e;
}
.question {
    background-color: var(--tw-custom-blue);
}
</style>
