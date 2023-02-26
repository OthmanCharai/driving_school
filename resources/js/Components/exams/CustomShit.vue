<template>
    <div class="items-center flex flex-col d gap-4">
        <div class="relative w-[50%] !bg-red-200 h-[30rem]" ref="imageWrapper">
            <img
                class="w-full h-full"
                :src="imageSrc"
                @load="onImageLoad"
                ref="image"
            />
            <div
                class="circle w-20 h-20"
                ref="dropzoneRefs"
                @dragover.prevent
                @drop="onCircleDrop($event)"
                v-for="circle in dropzones"
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
                v-for="(circle, index) of options"
                @mouseup="checkForIntersection"
                class="`mr-[${index}px]` text-3xl rounded-full bg-blue-500 w-20 h-20 flex justify-center items-center text-white"
                :style="{ marginRight: `${index * 10}rem` }"
                :circle="circle"
            >
                {{ circle.answer }}
            </Circle>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, provide } from "vue";
import Circle from "./Circle.vue";

const props = defineProps({
    question: Object,
});

const { dropzones, options } = props.question;

const imageSrc =
    "https://ig.sudinfo.be/i/0/0.05861/1x0.88278/d-20190623-3UNEN0.jpg?auth=a48f0";
const imageWrapper = ref(null);
const circles = [
    {
        id: 1,
        answer: 3,
    },
    {
        id: 3,
        answer: 2,
    },
    {
        id: 3,
        answer: 1,
    },
];
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

const checkForIntersection = ({ event, circle }) => {
    const dropzones = dropzoneRefs.value;
    const circleRect = circle.getBoundingClientRect();

    for (let j = 0; j < dropzones.length; j++) {
        const dropzone = dropzones[j];
        const dropzoneRect = dropzone?.getBoundingClientRect();

        if (isIntersecting(circleRect, dropzoneRect)) {
            // update the position of the circle to that of the dropzone
            circle.style.left = `${dropzoneRect.left}px`;
            circle.style.top = `${dropzoneRect.top}px`;
        }
    }
};

const onCircleDrop = (event) => {
    const circleId = draggedCircleId.value;
    alert(circleId);
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
