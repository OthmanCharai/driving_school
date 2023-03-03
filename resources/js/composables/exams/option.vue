<script setup>
const props = defineProps(["value", "isActive"]);
const toggled=props.isActive;
</script>

<template lang="">
    <div
        class="bg-slate-50 shadow-md border p-4 hover:shadow-lg focus:outline-none rounded-lg mt-13 flex justify-center items-center text-2xl"
        @click="isActive=!isActive"
        :class="{'border-2 border-blue-500 border-solid p-4':isActive}"
    >
        {{ value }}
    </div>
</template>

<style>
.mt-13 {
    margin-top: 3.2rem /* 48px */;
}
</style>
