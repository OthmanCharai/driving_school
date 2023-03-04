<template>
    <div class="pl-6">
        <VCol cols="12" md="6">
            <VFileInput
                :rules="iamgeRules"
                label="Question Image"
                accept="image/png, image/jpeg, image/bmp"
                placeholder="Pick an avatar"
                prepend-icon="tabler-camera"
                @input="changeImage"
            />
        </VCol>
        <h2 class="my-2" v-if="question.image">
            Click on the image to add a dropzone
        </h2>
        <VRow class="gap-x-8 mb-6 items-center">
            <div class="pt-4 relative h-[25rem] !w-[70%]">
                <img
                    v-if="question.image"
                    class="rounded-md w-full h-full"
                    :src="question.image"
                    @click="addDropzone"
                />
                <template v-for="(dropzone, index) in dropzones" :key="index">
                    <div
                        class="absolute rounded-full bg-blue-500 w-10 h-10 text-xl items-center justify-center text-white flex"
                        :style="{
                            top: `${dropzone.y}%`,
                            left: `${dropzone.x}%`,
                        }"
                    >
                        {{ index + 1 }}
                    </div>
                </template>
            </div>
            <div class="flex gap-4 my-4 flex-col w-[20%]">
                <template v-if="dropzones?.length">
                    <VBtn @click="undo"> undo </VBtn>
                    <VBtn @click="clearAll"> Clear All </VBtn></template
                >
            </div>
        </VRow>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    question: {
        type: null,
        required: true,
    },
});
const dropzones = ref(props.question?.dropzones);

const addDropzone = (event) => {
    const rect = event.target.getBoundingClientRect();
    const x = ((event.clientX - rect.left) / rect.width) * 100;
    const y = ((event.clientY - rect.top) / rect.height) * 100;
    const dropzone = { x, y };
    if (!dropzones.value) dropzones.value = [];
    dropzones.value.push(dropzone);
};

const clearAll = () => {
    dropzones.value.splice(0);
};

const undo = () => {
    dropzones.value.pop();
};

// const hasDropzones = computed(() => dropzones.length > 0);
const changeImage = (file) => {
    const fileReader = new FileReader();
    const { files } = file.target;
    if (files && files.length) {
        fileReader.readAsDataURL(files[0]);
        fileReader.onload = () => {
            if (typeof fileReader.result === "string")
                props.question.image = fileReader.result;
        };
    }
};
</script>
