import { createRouter, createWebHistory } from "vue-router";
import Landing from "./../Pages/Landing/landing.vue";
import NotFound from "./../Pages/not-founded.vue";
import ExamIndex from "./../Pages/exams/index.vue";
import ExamStart from "./../Pages/exams/start-exam.vue";
import Question from "./../Pages/exams/question.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "home",
            component: Landing,
        },
        {
            path: "/exams",
            name: "exams",
            component: ExamIndex,
        },
        {
            path: "/exam/:id",
            name: "exam",
            component: ExamStart,
        },
        {
            path: "/exam/:id/question/:id",
            name: "question",
            component: Question,
        },
        {
            path: "/exam-result",
            name: "examResult",
            component: () => import("./../Pages/exams/examResult/index.vue"),
        },
        {
            path: "/:catchAll(.*)",
            name: "NotFound",
            component: NotFound,
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.name !== "examResult") {
        import("@/helpers/style");
    }
    next();
});

export default router;
