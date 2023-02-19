import { ref, reactive } from "vue";
import axios from "axios";
const exam = ref({});
const exams = ref({});
export default function useExam() {
    const getExams = () => {
        const config = {
            headers: {
                Authorization:
                    "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMC4wLjAuMC9hcGkvcmVnaXN0ZXIiLCJpYXQiOjE2NzYzMzU0MDMsImV4cCI6MTY3NjMzOTAwMywibmJmIjoxNjc2MzM1NDAzLCJqdGkiOiJnM2lDZFVRdENmemUzZjFqIiwic3ViIjoiMTIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.zpZRH7pXIaxY7H4z19QnTip0MJQfC2EBkuzSRaJNACs",
            },
        };
        console.log(config);
        axios
            .get("api/exam", config)
            .then((response) => {
                exams.value = response.data;
                // console.log(exams.value.data);
            })
            .catch((error) => {
                console.log(error);
            });
    };
    const getExam = async (id) => {
        return axios
            .get("/api/exam/" + id)
            .then((response) => {
                exam.value = response.data;
            })
            .catch((error) => {
                console.log("error");
            });
    };

    return {
        getExams,
        getExam,
        exam,
        exams,
    };
}
