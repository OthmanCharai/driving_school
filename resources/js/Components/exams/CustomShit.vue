<template>
    <div class="relative w-[40rem] !bg-red-200" ref="imageWrapper">
        <img
            class="w-full h-full"
            :src="imageSrc"
            @load="onImageLoad"
            ref="image"
        />
        <div
            class="circle w-20 h-20"
            @dragover.prevent
            @drop="onCircleDrop($event)"
            v-for="circle in dropZones"
            :key="circle.id"
            :style="{ left: circle.xPos + '%', top: circle.yPos + '%' }"
        >
            <div
                class="circle-outline border border-dashed border-white rounded-full"
            ></div>
        </div>
    </div>
    <div class="flex gap-x-2">
        <Circle
            v-for="circle in circles"
            class="text-3xl rounded-full bg-blue-500 w-20 h-20 flex justify-center items-center text-white"
            :circle="circle"
        >
            {{ circle }}
        </Circle>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, provide } from "vue";
import Circle from "./Circle.vue";

const imageSrc =
    "https://ig.sudinfo.be/i/0/0.05861/1x0.88278/d-20190623-3UNEN0.jpg?auth=a48f0";
const imageWrapper = ref(null);
const circles = [
    {
        id: 1,
        title: 2,
    },
    {
        id: 3,
        title: 2,
    },
];
const draggedCircleId = ref(0);
provide("draggedCircleId", draggedCircleId);
const image = ref(null);
const dropZones = reactive([
    { id: 1, xPos: 25, yPos: 25 },
    { id: 2, xPos: 50, yPos: 50 },
    { id: 3, xPos: 75, yPos: 75 },
]);

const onImageLoad = () => {
    const imageWidth = image.value.width;
    const imageHeight = image.value.height;
    dropZones.forEach((circle) => {
        circle.xPos = (circle.xPos / imageWidth) * 100;
        circle.yPos = (circle.yPos / imageHeight) * 100;
    });
};

onMounted(() => {
    const imageWrapperWidth = imageWrapper.value.offsetWidth;
    const imageWrapperHeight = imageWrapper.value.offsetHeight;
    dropZones.forEach((circle) => {
        circle.xPos = (circle.xPos / 100) * imageWrapperWidth;
        circle.yPos = (circle.yPos / 100) * imageWrapperHeight;
    });
});

const onCircleMouseDown = (circle, event) => {
    event.dataTransfer.setData("circleId", circle.id);
};

const onCircleDrop = (event) => {
    const circleId = draggedCircleId.value;
    alert(circleId);
    const circle = dropZones.find((c) => c.id == circleId);
    if (circle) {
        const rect = event.target.getBoundingClientRect();
        circle.xPos = ((event.clientX - rect.left) / rect.width) * 100;
        circle.yPos = ((event.clientY - rect.top) / rect.height) * 100;
    }
};

onMounted(() => {
    const options = {
        root: null,
        rootMargin: "0px",
        threshold: 1.0,
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                console.log(`Box 1 and Box 2 intersect!`);
            }
        });
    }, options);

    observer.observe(box1.value);
    observer.observe(box2.value);
});
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
