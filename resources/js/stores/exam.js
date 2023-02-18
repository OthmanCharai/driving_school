import { ref } from "vue";
import { defineStore } from "pinia";

export const useExamStore = defineStore("exam", () => {
    const currentQuestionIndex = ref(-1);
    const currentSubExamIndex = ref(0);
    const subExams = ref(null);

    function showNextQuestion() {
        const currentQuestionIndexValue = currentQuestionIndex.value;
        const subExamsValue = subExams.value;
        if (currentQuestionIndexValue === -1) {
            currentQuestionIndex.value = 0;
            return;
        }
        // check if last question
        const questionsCount =
            subExamsValue[currentQuestionIndexValue]?.questions?.length;
        if (questionsCount === currentQuestionIndexValue + 1) {
            currentSubExamIndex.value += 1;
            currentQuestionIndexValue.value = -1;
            return;
        }
        currentQuestionIndex.value += 1;
    }

    function showNextSubExam() {
        currentSubExamIndex.value += 1;
    }

    return {
        currentQuestionIndex,
        currentSubExamIndex,
        subExams,
        showNextQuestion,
        showNextSubExam,
    };
});
