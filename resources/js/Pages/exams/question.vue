<template lang="">

    <div class="flex h-[80%] gap-10 w-full">
        <div class="flex-1 mr-44 h-40 w-full ml-10">
            <div
                class="row question rounded-lg h-32 mt-2 text-white flex items-center justify-center"
            >
                {{ question.question }}
            </div>
            <div v-for="item in question.options">
                <ExamOption
                    @click="selectOption(item.id)"
                    :isActive="selectedOption === item.id"
                    :value="item.answer"
                    :key="item.id"
                    
                />
            </div>
        </div>
        <div class="col-md-6">
            <img
                :src="question.image"
                class="w-full h-2/3 border-3 border-blue-400"
                alt="Image"
            />
        </div>
    </div>
</template>
<script setup>
import ExamOption from "./../../Components/exams/option.vue";
import { ref } from "vue";
import { useExamStore } from "@/stores/exam";
import { storeToRefs } from "pinia";

const { selectOption } = useExamStore();
const { selectedOption } = storeToRefs(useExamStore());

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
