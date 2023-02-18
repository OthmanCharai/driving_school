<script setup>
const props = defineProps(["exam", "examIndex"]);
</script>

<template>
    <div class="big-month">{{ exam?.name }}</div>
    <hr class="w-full" />
    <div class="mt-3 text-end">part {{ examIndex }}</div>
</template>
