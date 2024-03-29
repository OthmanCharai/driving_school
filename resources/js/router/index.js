import { setupLayouts } from "virtual:generated-layouts";
import { createRouter, createWebHistory } from "vue-router";
import { isUserLoggedIn } from "./utils";
import routes from "~pages";
import { canNavigate } from "@layouts/plugins/casl";

import Landing from "../Pages/Landing/landing.vue";
import NotFound from "../Pages/not-founded.vue";
import ExamIndex from "./../Pages/exams/index.vue";
import ExamStart from "./../Pages/exams/start-exam.vue";
import Question from "./../Pages/exams/question.vue";
import Contact from "@/Pages/Contact/index.vue";

const clientRoutes = [
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
        path: "/examResult",
        name: "examResult",
        component: () => import("./../Pages/exams/examResult/index.vue"),
    },
    {
        path: "/:catchAll(.*)",
        name: "NotFound",
        component: NotFound,
    },
    {
        path: "/contact",
        name: "contact",
        component: Contact,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        // ℹ️ We are redirecting to different Pages based on role.
        // NOTE: Role is just for UI purposes. ACL is based on abilities.
        {
            path: "/admin",
            redirect: (to) => {
                const userData = JSON.parse(
                    localStorage.getItem("userData") || "{}"
                );
                const userRole =
                    userData && userData.role ? userData.role : null;
                if (userRole === "admin")
                    return { name: "dashboards-analytics" };
                if (userRole === "client") return { name: "access-control" };

                return { name: "admin-login", query: to.query };
            },
        },
        {
            path: "/pages/user-profile",
            redirect: () => ({
                name: "pages-user-profile-tab",
                params: { tab: "profile" },
            }),
        },
        {
            path: "/pages/account-settings",
            redirect: () => ({
                name: "pages-account-settings-tab",
                params: { tab: "account" },
            }),
        },

        ...setupLayouts(routes),
        ...clientRoutes,
    ],
});

// Docs: https://router.vuejs.org/guide/advanced/navigation-guards.html#global-before-guards
router.beforeEach((to) => {
    if (to.path.startsWith("/admin")) {
        import("@/@core/scss/template/index.scss");
        import("@/styles/styles.scss");
    } else if (window.location.pathname != "/examResult") {
        import("@/helpers/style");
    }

    const isLoggedIn = isUserLoggedIn();
    // if (!to.path.startsWith("/admin")) {
        // Do nothing if route starts with "/admin"
        return;
    // }
    /*

    ℹ️ Commented code is legacy code

    if (!canNavigate(to)) {
      // Redirect to login if not logged in
      // ℹ️ Only add `to` query param if `to` route is not index route
      if (!isLoggedIn)
        return next({ name: 'login', query: { to: to.name !== 'index' ? to.fullPath : undefined } })

      // If logged in => not authorized
      return next({ name: 'not-authorized' })
    }

    // Redirect if logged in
    if (to.meta.redirectIfLoggedIn && isLoggedIn)
      next('/')

    return next()

    */
    // if (canNavigate(to)) {
    //     if (to.meta.redirectIfLoggedIn && isLoggedIn) return to.path;
    // } else {
    //     if (isLoggedIn) return { name: "not-authorized" };
    //     else
    //         return {
    //             name: "admin-login",
    //             query: { to: to.name !== "index" ? to.fullPath : undefined },
    //         };
    // }
});
export default router;
