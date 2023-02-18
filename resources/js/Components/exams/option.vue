<script setup>
const props = defineProps(["value", "isActive"]);
</script>

<template lang="">
    <div
        class="bg-slate-50 shadow-md border p-4 hover:shadow-lg focus:outline-none rounded-lg mt-13 flex justify-center items-center text-2xl"
    >
        {{ value }}
    </div>
</template>

<style>
.mt-13 {
    margin-top: 3.2rem /* 48px */;
}
</style>
