<template>
    <div class="pt-4 relative h-[20rem] !w-[70%]">
        <h2 v-if="!dropzones.length">Click on the image to add a dropzone</h2>
        <img
            class="rounded object-cover w-full h-full"
            :src="data.image"
            @click="addDropzone"
        />
        <!-- <div class="relative"> -->
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
        <!-- </div> -->
        <div v-if="dropzones.length" class="flex gap-y-4">
            <VBtn @click="undo"> undo </VBtn>
            <VBtn @click="clearAll"> Clear All </VBtn>
        </div>
    </div>
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
