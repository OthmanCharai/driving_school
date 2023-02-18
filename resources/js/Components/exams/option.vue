<template lang="">
    <div
        class="col bg-slate-50 shadow-md border p-4 hover:shadow-lg focus:outline-none  rounded-lg  mt-13  flex justify-center items-center "
    >
        <h4 class="text-black ">{{ value }}</h4>
    </div>
</template>
<script setup>
const props = defineProps(["value"]);
import {ref} from "vue";

</script>
<style>

.mt-13 {
    margin-top: 3.2rem/* 48px */;
}


</style>
