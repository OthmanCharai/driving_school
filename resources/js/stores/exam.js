import { computed, ref } from "vue";
import { defineStore } from "pinia";
import examService from "@/services/exam";
import { useRouter } from "vue-router";
import { useTimerStore } from "./timer";

const DEFAULT_OPTION_VALUE = null;

export const useExamStore = defineStore("exam", () => {
    const router = useRouter();
    const { startTimer, resetTimer } = useTimerStore();
    const currentQuestionIndex = ref(-1);
    const currentSubExamIndex = ref(0);
    const selectedOption = ref(0);
    const subExams = ref(null);
    const answers = ref([]);

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

        const questionId = currentQuestion.value.id;
        const selectedOptionId = selectedOption.value;

        const existingResponse = answers.value[
            currentSubExamIndex.value
        ].response.find((r) => r.question_id === questionId);

        if (existingResponse) {
            // If a response already exists with the given question_id, update its option_id instead of adding a new response
            existingResponse.option_id = selectedOptionId;
        } else {
            // Otherwise, add a new response to the array
            const newResponse = {
                question_id: questionId,
            };
            
            if (currentQuestion.value?.dropzones?.length) {
                newResponse.type = "dropzones";
                newResponse.options = selectedOption.value || [];
            } else {
                newResponse.option_id = selectedOptionId;
            }
            answers.value[currentSubExamIndex.value].response.push(newResponse);
        }
    }

    async function submitAnswers() {
        let response = await examService.submitAnswers(answers.value);
        console.log(response);
        const {
            data: {
                data: { id: examResultID },
            },
        } = response;
        window.location.href = `/examResult?id=${examResultID}`;
    }

    function showNextQuestion() {
        saveCurrentQuestionAnswer();
        const currentQuestionIndexValue = currentQuestionIndex.value;
        const subExamsList = subExams.value;
        resetTimer();
        // check if last question
        const questionsCount =
            subExamsList[currentSubExamIndex.value]?.questions?.length;

        if (questionsCount === currentQuestionIndexValue + 1) {
            // IN last exam?
            if (subExamsList.length === currentSubExamIndex.value + 1) {
                return submitAnswers();
            }
            currentSubExamIndex.value += 1;
            currentQuestionIndex.value = -1;
            return;
        }

        currentQuestionIndex.value += 1;

        if (currentQuestionIndex.value !== -1) {
            startTimer(showNextQuestion);
        }
        selectOption(DEFAULT_OPTION_VALUE);
    }

    function showPreviousQuestion() {
        currentQuestionIndex.value -= 1;
    }

    function showNextSubExam() {
        currentSubExamIndex.value += 1;
    }

    function selectOption(newSelectedOption) {
        selectedOption.value = newSelectedOption;
    }

    function resetExam() {
        currentQuestionIndex.value = -1;
        currentSubExamIndex.value = 0;
        selectOption(DEFAULT_OPTION_VALUE);
        subExams.value = null;
        answers.value = [];
    }

    function endExam() {
        resetTimer();
        resetExam();
        router.push("/");
    }

    return {
        endExam,
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
        showPreviousQuestion,
        submitAnswers,
    };
});
