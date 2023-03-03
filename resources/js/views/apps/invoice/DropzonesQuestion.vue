<template>
    <h2 class="my-2 pl-3">Click on the image to add a dropzone</h2>
    <VRow class="gap-8 mb-6 items-center justify-center">
        <div class="pt-4 relative h-[20rem] !w-[70%]">
            <img
                class="rounded object-cover w-full h-full"
                :src="data.image"
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
        <div class="flex gap-4 my-4 flex-row w-[20%]">
            <template v-if="dropzones.length">
                <VBtn @click="undo"> undo </VBtn>
                <VBtn @click="clearAll"> Clear All </VBtn></template
            >
        </div>
    </VRow>
</template>

<script>
import { reactive, computed } from "vue";

export default {
    setup() {
        const data = reactive({
            image: "https://picsum.photos/800/600",
        });

        const dropzones = reactive([]);

        const addDropzone = (event) => {
            const rect = event.target.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;
            const dropzone = { x, y };
            dropzones.push(dropzone);
        };

        const clearAll = () => {
            dropzones.splice(0);
        };

        const undo = () => {
            dropzones.pop();
        };

        const hasDropzones = computed(() => dropzones.length > 0);

        return { data, dropzones, addDropzone, clearAll, undo, hasDropzones };
    },
};
</script>
