import { createRouter, createWebHistory } from 'vue-router';
import Landing from './../Pages/Landing/landing.vue';
import NotFound from "./../Pages/not-founded.vue";
import ExamIndex from "./../Pages/exams/index.vue";
import ExamStart from './../Pages/exams/start-exam.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Landing
    },
    {
        path:"/exams",
        name:"exams",
        component:ExamIndex
    },
    {
      path:"/exam/:id",
      name:'exam',
      component:ExamStart
    },
    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: NotFound
    }

  ]
})

export default router
