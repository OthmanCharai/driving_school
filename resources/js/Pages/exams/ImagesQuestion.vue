<script setup>
import { ref } from "vue";
import { useExamStore } from "@/stores/exam";
import { storeToRefs } from "pinia";

const props = defineProps({
    question: Object,
});

const { selectOption } = useExamStore();
const { selectedOption } = storeToRefs(useExamStore());

const images = [
    {
        url: "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAIkATQMBIgACEQEDEQH/xAAYAAEBAQEBAAAAAAAAAAAAAAAAAQIHA//EACMQAQEBAAICAQMFAAAAAAAAAAABESFBAjFRImFxEmKRscH/xAAWAQEBAQAAAAAAAAAAAAAAAAAAAQL/xAAWEQEBAQAAAAAAAAAAAAAAAAAAARH/2gAMAwEAAhEDEQA/AOIgvk1W0Dj9Pvn4QF4z7rc4z32yoALJs0NRq5JM+OUuW/TLn51ECXOZxei3kOlC3bvaEUQt+mcTjv5QavN4mAh9gAlsuzigCrYi7vuoIGbi2WZszZsOwRfG5bxLx2eXF5QAC8gGDfjf3WBWF47MJnYG5M6Q7AXpCCC27dyQTF34BZvjd9WfzEs4l/1rxuS+vhm+wSXJZ8gYC+OdlRQQXOEAWfHpFk3eQF4T+wEVLWbdgF8r0S4yIy9PH6vUX8MeDatQttttu2rM533nCL5X9V3MBPuCAzfaKiIIoBK2w2pAAUABlFEEFBBFQABQXlFQBRWkAEDAAAQAFH//2Q==",
        id: 1,
    },
    {
        url: "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAIkATQMBIgACEQEDEQH/xAAYAAEBAQEBAAAAAAAAAAAAAAAAAQIHA//EACMQAQEBAAICAQMFAAAAAAAAAAABESFBAjFRImFxEmKRscH/xAAWAQEBAQAAAAAAAAAAAAAAAAAAAQL/xAAWEQEBAQAAAAAAAAAAAAAAAAAAARH/2gAMAwEAAhEDEQA/AOIgvk1W0Dj9Pvn4QF4z7rc4z32yoALJs0NRq5JM+OUuW/TLn51ECXOZxei3kOlC3bvaEUQt+mcTjv5QavN4mAh9gAlsuzigCrYi7vuoIGbi2WZszZsOwRfG5bxLx2eXF5QAC8gGDfjf3WBWF47MJnYG5M6Q7AXpCCC27dyQTF34BZvjd9WfzEs4l/1rxuS+vhm+wSXJZ8gYC+OdlRQQXOEAWfHpFk3eQF4T+wEVLWbdgF8r0S4yIy9PH6vUX8MeDatQttttu2rM533nCL5X9V3MBPuCAzfaKiIIoBK2w2pAAUABlFEEFBBFQABQXlFQBRWkAEDAAAQAFH//2Q==",
        id: 2,
    },
    {
        url: "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAIkATQMBIgACEQEDEQH/xAAYAAEBAQEBAAAAAAAAAAAAAAAAAQIHA//EACMQAQEBAAICAQMFAAAAAAAAAAABESFBAjFRImFxEmKRscH/xAAWAQEBAQAAAAAAAAAAAAAAAAAAAQL/xAAWEQEBAQAAAAAAAAAAAAAAAAAAARH/2gAMAwEAAhEDEQA/AOIgvk1W0Dj9Pvn4QF4z7rc4z32yoALJs0NRq5JM+OUuW/TLn51ECXOZxei3kOlC3bvaEUQt+mcTjv5QavN4mAh9gAlsuzigCrYi7vuoIGbi2WZszZsOwRfG5bxLx2eXF5QAC8gGDfjf3WBWF47MJnYG5M6Q7AXpCCC27dyQTF34BZvjd9WfzEs4l/1rxuS+vhm+wSXJZ8gYC+OdlRQQXOEAWfHpFk3eQF4T+wEVLWbdgF8r0S4yIy9PH6vUX8MeDatQttttu2rM533nCL5X9V3MBPuCAzfaKiIIoBK2w2pAAUABlFEEFBBFQABQXlFQBRWkAEDAAAQAFH//2Q==",
        id: 3,
    },
];
</script>
<template>
    <div class="items-center flex flex-col gap-4">
        <div
            class="bg-primary w-[30%] h-28 rounded-lg flex justify-center items-center text-4xl"
        >
            Select the right answer
        </div>
        <div class="flex gap-2 p-0 w-full justify-center mt-20">
            <div
                v-for="image in images"
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
