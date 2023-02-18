<template lang="">
    <main class="container mx-auto py-32">
        <div class="flex h-[calc(100vh/3)] gap-10 w-full">
            <div class="flex-1 mr-44  h-40 w-full ml-10">
                <div class="row question rounded-lg h-32 mt-2"></div>
                <div v-for="item in data">
                    <ExamOption :value="item" :key="item" />
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
    </main>
</template>
<script setup>
import ExamOption from "./../../Components/exams/option.vue";
const data = ["1", "2", "3", "4"];
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
