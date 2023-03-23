import { ref } from "vue";
import { defineStore } from "pinia";

export const useTimerStore = defineStore("timer", () => {
    const timeLeft = ref(0);
    let timeInterval = null;

    function resetTimer() {
        if (timeInterval) {
            clearInterval(timeInterval);
        }
    }

    function startTimer(newValue, callback) {
        timeLeft.value = newValue;
        timeInterval = setInterval(() => {
            timeLeft.value -= 0.01;
            if (timeLeft.value <= 0) {
                clearInterval(timeInterval); // Stop the interval
                callback();
            }
        }, 10); // 10ms
    }

    return {
        timeLeft,
        resetTimer,
        startTimer,
    };
});

//
