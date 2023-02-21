import axios from "axios";

const config = {
    headers: {
        Authorization:
            "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMC4wLjAuMC9hcGkvcmVnaXN0ZXIiLCJpYXQiOjE2NzYzMzU0MDMsImV4cCI6MTY3NjMzOTAwMywibmJmIjoxNjc2MzM1NDAzLCJqdGkiOiJnM2lDZFVRdENmemUzZjFqIiwic3ViIjoiMTIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.zpZRH7pXIaxY7H4z19QnTip0MJQfC2EBkuzSRaJNACs",
    },
};

const submitAnswers = (answers) =>
    axios.post(
        "/api/score",
        {
            data: answers,
        },
        config
    );

export default {
    submitAnswers,
};
