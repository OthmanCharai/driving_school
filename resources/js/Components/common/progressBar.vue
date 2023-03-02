<template>
    <div class="relative pt-1">
        <div
            class="overflow-hidden h-2  text-xs flex rounded bg-transparent flex-row-reverse"
        >
            <div
                :class="[progressBarColor]"
                :style="{ width: progressWidth, transform: 'scaleX(-1)' }"
            ></div>
        </div>
        <div class="flex justify-between text-xs">
            <div>{{ max }}</div>
            <div>0</div>
        </div>
    </div>
</template>

<script>
import { computed } from "vue";

export default {
    name: "CountDownTimerProgressBar",
    props: {
        value: {
            type: Number,
            required: true,
        },
        max: {
            type: Number,
            required: true,
        },
    },
    setup(props) {
        const progressBarColor = computed(() => {
            const percent = (props.value / props.max) * 100;
            if (percent >= 66) {
                return "bg-green-500";
            } else if (percent >= 33) {
                return "bg-yellow-500";
            } else {
                return "bg-red-500";
            }
        });

        const progressWidth = computed(
            () => `${(props.value / props.max) * 100}%`
        );

        return { progressBarColor, progressWidth };
    },
};
</script>

<style>
/* You can customize the progress bar's height and color here */
</style>
