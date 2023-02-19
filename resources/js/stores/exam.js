import { computed, ref } from "vue";
import { defineStore } from "pinia";
import { submitAnswers } from "@/services/exam";
import { useRouter } from "vue-router";

const fakeData = [
    {
        "Ms. Catalina Dach": [
            [true],
            [true],
            [false],
            [true],
            [true],
            [true],
            [true],
            [true],
            [true],
            [true],
        ],
        score: 9,
    },
    {
        "Ms. Catalina Dach": [
            [true],
            [true],
            [false],
            [true],
            [true],
            [true],
            [true],
            [true],
            [true],
            [true],
        ],
        score: 9,
    },
];

export const useExamStore = defineStore("exam", () => {
    const router = useRouter();

    const currentQuestionIndex = ref(-1);
    const currentSubExamIndex = ref(0);
    const selectedOption = ref(0);
    const subExams = ref(null);
    const answers = ref([]);
    const quizResult = ref(fakeData);

    const currentSubExam = computed(() => {
        if (!subExams.value) return;
        return subExams.value[currentSubExamIndex.value];
    });

    const currentQuestion = computed(() => {
        const currentQuestionIndexValue = currentQuestionIndex.value;
        if (currentQuestionIndexValue === -1) return null;
        return currentSubExam.value?.questions[currentQuestionIndexValue];
    });

    function saveCurrentQuestionAnswer() {
        const currentQuestionIndexValue = currentQuestionIndex.value;
        if (currentQuestionIndexValue === -1) {
            const currentExamID = currentSubExam.value.id;
            answers.value.push({
                sub_exam_id: currentExamID,
                response: [],
            });
            return;
        }

        const response = {
            question_id: currentQuestion.value.id,
            option_id: selectedOption.value,
        };

        answers.value[currentSubExamIndex.value].response.push(response);
        // todo : change for prev
    }

    async function showResults() {
        try {
            let data = await submitAnswers(answers.value);
        } catch (e) {}

        quizResult.value = fakeData;
        // router.push({ name: "examResult" });
        window.location.href = '/examResult'
    }

    function showNextQuestion() {
        saveCurrentQuestionAnswer();
        const currentQuestionIndexValue = currentQuestionIndex.value;
        const subExamsList = subExams.value;
        if (currentQuestionIndexValue === -1) {
            currentQuestionIndex.value = 0;
            return;
        }

        // check if last question
        const questionsCount =
            subExamsList[currentSubExamIndex.value]?.questions?.length;

        if (questionsCount === currentQuestionIndexValue + 1) {
            // IN last exam?
            if (subExamsList.length === currentSubExamIndex.value + 1) {
                return showResults();
            }
            currentSubExamIndex.value += 1;
            currentQuestionIndex.value = -1;
            return;
        }

        currentQuestionIndex.value += 1;
    }

    function showNextSubExam() {
        currentSubExamIndex.value += 1;
    }

    function selectOption(newSelectedOption) {
        selectedOption.value = newSelectedOption;
    }

    return {
        currentQuestionIndex,
        currentSubExamIndex,
        subExams,
        showNextQuestion,
        showNextSubExam,
        currentQuestion,
        currentSubExam,
        selectedOption,
        selectOption,
        answers,
    };
});
