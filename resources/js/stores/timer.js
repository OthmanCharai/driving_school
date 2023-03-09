import { ref } from "vue";
import { defineStore } from "pinia";

export const useTimerStore = defineStore("timer", () => {
    const timeLeft = ref(0);
    let timeInterval = null;

    function resetTimer() {
        timeLeft.value = 1000;
        if (timeInterval) {
            clearInterval(timeInterval);
        }
    }

    function startTimer(callback) {
        timeInterval = setInterval(() => {
            timeLeft.value -= 0.01;
            if (timeLeft.value <= 0) {
                clearInterval(timeInterval); // Stop the interval
                callback();
            }
        }, 10); // 1s
    }

    return {
        timeLeft,
        resetTimer,
        startTimer,
    };
});

//
