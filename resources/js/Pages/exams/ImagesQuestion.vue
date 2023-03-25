<script setup>
import { ref } from "vue";
import { useExamStore } from "@/stores/exam";
import { storeToRefs } from "pinia";

const props = defineProps({
    question: Object,
});

const { selectOption } = useExamStore();
const { selectedOption } = storeToRefs(useExamStore());

</script>
<template>
    <div class="items-center flex flex-col gap-4">
        <div
            class="bg-primary w-[30%] h-28 rounded-lg flex justify-center items-center text-4xl"
        >
            {{ question.question }}
        </div>
        <div class="flex gap-2 p-0 w-full justify-center mt-20">
            <div
                v-for="image in question.images"
                @click="selectOption(image.id)"
                class="border-6 rounded-md w-[24%]"
                :class="{
                    ' border-blue-500 border-8': image.id === selectedOption,
                    ' border-transparent border-8': image.id !== selectedOption,
                }"
            >
                <img :src="image.url" alt="" class="w-full h-[40rem]" />
            </div>
        </div>
    </div>
</template>
