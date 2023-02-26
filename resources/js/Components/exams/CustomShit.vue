<template>
    <div class="items-center flex flex-col d gap-4">
        <div class="relative w-[50%] !bg-red-200 h-[30rem]" ref="imageWrapper">
            <img
                class="w-full h-full"
                :src="question.image"
                @load="onImageLoad"
                ref="image"
            />
            <div
                class="circle w-20 h-20"
                ref="dropzoneRefs"
                @dragover.prevent
                @drop="onCircleDrop($event)"
                v-for="circle in question.dropzones"
                :key="circle.id"
                :style="{
                    left: circle.x_position + '%',
                    top: circle.y_position + '%',
                }"
            >
                <div
                    class="circle-outline border border-dashed border-white rounded-full"
                ></div>
            </div>
        </div>
        <div class="flex gap-x-2 gap-y-2">
            <Circle
                v-for="(circle, index) of question.options"
                @mouseup="checkForIntersection"
                class="`mr-[${index}px]` text-3xl rounded-full bg-blue-500 w-20 h-20 flex justify-center items-center text-white"
                :style="{ marginRight: `${index * 10}rem` }"
                :circle="circle"
            >
                {{ index + 1 || circle.answer }}
            </Circle>
        </div>
    </div>
</template>

<script setup>
import { useExamStore } from "@/stores/exam";
import { storeToRefs } from "pinia";
import { ref, reactive, provide } from "vue";
import Circle from "./Circle.vue";

const props = defineProps({
    question: Object,
});

// const { dropzones, options, image:imageSrc } = props.question;
const { selectedOption } = storeToRefs(useExamStore());

const imageWrapper = ref(null);
const dropzoneRefs = ref(null);

const draggedCircleId = ref(0);
provide("draggedCircleId", draggedCircleId);
const image = ref(null);

function isIntersecting(circle, dropzone) {
    const circleCenterX = circle.left + circle.width / 2;
    const circleCenterY = circle.top + circle.height / 2;
    const dropzoneCenterX = dropzone.left + dropzone.width / 2;
    const dropzoneCenterY = dropzone.top + dropzone.height / 2;
    const distanceX = circleCenterX - dropzoneCenterX;
    const distanceY = circleCenterY - dropzoneCenterY;
    const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);
    return (
        distance >= 0 && distance <= circle.width && distance <= circle.height
    );
}

// function to add an option to selectedOption array
function addOption(option_id, dropzone_id) {
    // if selectedOption is null, create an array and set it as the new value
    if (!selectedOption.value) {
        selectedOption.value = [];
    }

    // find the index of the option with the matching dropzone_id
    const index = selectedOption.value.findIndex(
        (opt) => opt.dropzone_id === dropzone_id || opt.option_id === option_id
    );
    // if no option was found, return
    if (index !== -1) {
        return;
    }
    // push the new option to the array
    selectedOption.value.push({ option_id, dropzone_id });
}

// function to remove an option from selectedOption array
function removeOption(option_id, dropzone_id) {
    // if selectedOption is null or empty, return
    if (!selectedOption.value || selectedOption.value.length === 0) {
        return;
    }
    // find the index of the option with the matching dropzone_id
    const index = selectedOption.value.findIndex(
        (opt) => opt.dropzone_id === dropzone_id && opt.option_id === option_id
    );
    // if no option was found, return
    if (index === -1) {
        return;
    }
    // remove the option from the array
    selectedOption.value.splice(index, 1);
}

const fillDropzone = (dropzone, option_id) => {
    const dropzone_id = dropzone.id;
    addOption(option_id, dropzone_id);
};

const checkForIntersection = ({ event, circle, circleID }) => {
    const dropzonesDivs = dropzoneRefs.value;
    const { dropzones } = props.question;
    const circleRect = circle.getBoundingClientRect();

    for (let j = 0; j < dropzonesDivs.length; j++) {
        const dropzone = dropzonesDivs[j];
        const dropzoneRect = dropzone?.getBoundingClientRect();

        if (isIntersecting(circleRect, dropzoneRect)) {
            // update the position of the circle to that of the dropzone
            circle.style.left = `${dropzoneRect.left}px`;
            circle.style.top = `${dropzoneRect.top}px`;
            fillDropzone(dropzones[j], circleID);
        } else {
            removeOption(circleID, dropzones[j].id, circleRect, dropzoneRect);
        }
    }
    draggedCircleId.value = null;
};

const onCircleDrop = (event) => {
    const { dropzones } = props.question;
    const circleId = draggedCircleId.value;
    const circle = dropzones.find((c) => c.id == circleId);
    if (circle) {
        const rect = event.target.getBoundingClientRect();
        circle.xPos = ((event.clientX - rect.left) / rect.width) * 100;
        circle.yPos = ((event.clientY - rect.top) / rect.height) * 100;
    }
};
</script>

<style scoped>
.image-wrapper {
    @apply relative;
}

.circle {
    @apply absolute bg-gray-400 bg-opacity-50 rounded-full;
}

.circle-outline {
    @apply w-full h-full border-2 border-dashed border-white rounded-full;
}
</style>
