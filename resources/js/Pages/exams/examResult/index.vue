<script setup>
import { onMounted, ref } from "vue";
import examService from "@/services/exam";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();

const examResult = ref(null);

onMounted(async () => {
    let { data } = await examService.getExamResult(route.query.id);
    examResult.value = data;
});

const getCorrectAnswersCount = (subExam) =>
    subExam.answers.filter((answer) => answer == "true").length;
</script>
<template>
    <link href="img/favicon.ico" rel="icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet"
    />

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet"
    />
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <!-- Spinner Start -->
    <!-- <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
        <div
            class="spinner-grow text-primary"
            style="width: 3rem; height: 3rem"
            role="status"
        >
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->

    <!-- Navbar Start -->

    <div v-if="examResult" class="exam-page">
        <div class="exam-header p-5" id="exam_result">
            <div class="container">
                <div class="row border-bottom">
                    <div class="col-6">
                        <!-- <h1>
                            Rijschoolmajed
                            <span class="px-5 d-block h3">ماجد العبيدي</span>
                        </h1> -->
                    </div>
                    <div class="col-6">
                        <!-- <img
                            src="images/1670206666638d54cac0ff3.png"
                            alt="Rijschoolmajed  :              Kvk nr : 60475048"
                            class="float-end"
                        /> -->
                    </div>
                </div>

                <div class="student-info pb-3 mb-2 border-bottom">
                    <div class="row" style="direction: rtl">
                        <div class="col-12">
                            <h2 class="text-center p-2">نتيجة الاختبار</h2>
                        </div>
                        <div class="col-8">
                            <ul
                                class="info p-0"
                                style="direction: rtl; text-align: right"
                            >
                                <li class="fs-5">
                                    <span class="fw-bold me-4 text-primary"
                                        >الاسم: </span
                                    ><span class=""> </span>
                                </li>
                                <li class="fs-5">
                                    <span class="fw-bold me-4 text-primary"
                                        >رقم الممتحن: </span
                                    ><span class=""></span>
                                </li>
                                <li class="fs-5">
                                    <span class="fw-bold me-4 text-primary"
                                        >الاختبار: </span
                                    ><span class="">اختبار تجريبي</span>
                                </li>
                                <li class="fs-5">
                                    <span class="fw-bold me-4 text-primary"
                                        >تاريخ: </span
                                    ><span class="">
                                        {{ examResult.created_at }}</span
                                    >
                                </li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <div v-if="!examResult.passedExam" class="col-lg-12 ps-5 text-start">
                                <i
                                    class="far fa-thumbs-down text-danger"
                                    style="font-size: 115px"
                                ></i>
                                <h3 class="fw-bold mt-2">حاول مرة اخرى</h3>
                            </div>
                            <div v-else class="col-lg-12 ps-5 text-start">
                                <i
                                    class="far fa-thumbs-up text-success"
                                    style="font-size: 115px"
                                ></i>
                                <h3 class="fw-bold mt-2">تهنئة</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Exam Start -->
            <div class="container" id="print_content">
                <div class="row">
                    <div class="col-lg-12">
                        <div
                            v-for="(
                                subExam, subExamName
                            ) in examResult.subExams"
                            class="widget p-4 mb-3"
                        >
                            <div class="widget-head">
                                <h4>
                                    <span>
                                        {{ getCorrectAnswersCount(subExam) }}
                                        / {{ subExam.answers.length }}</span
                                    >
                                    {{ subExamName }}
                                    <span
                                        class="float-end h6 text-muted"
                                        style="direction: rtl"
                                        >الاجابات للنجاح:
                                        {{ Math.floor(subExam.minScore) }}</span
                                    >
                                </h4>
                                <hr />
                            </div>
                            <div class="widget-content">
                                <ul class="result">
                                    <li
                                        v-for="(
                                            answer, index
                                        ) in subExam.answers"
                                        class="mb-3 mr-2"
                                        :class="[
                                            answer == 'true'
                                                ? 'bg-success'
                                                : 'bg-red-50',
                                        ]"
                                    >
                                        <a
                                            href="exam-question.php?result_id=9280&question_id=1957"
                                            title="ماذا يجب ان تفعل هنا ؟"
                                            >{{ index + 1 }}</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-4 text-center" id="toolbar">
            <a href="./" class="btn btn-primary"
                ><i class="fa fa-home"></i> الرئيسية</a
            >
            <a href="#" class="btn btn-primary" id="print"
                ><i class="fa fa-print"></i> طباعة</a
            >

            <div class="btn-group dropup">
                <button
                    type="button"
                    class="btn btn-primary dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i class="fa fa-share"></i> مشاركة
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a
                            class="dropdown-item"
                            href="https://www.facebook.com/sharer/sharer.php?u=https://bestetheorie.nl/exam-result.php?id=9280"
                            target="_blank"
                            ><i class="fab fa-facebook"></i> Facebook</a
                        >
                    </li>
                    <li>
                        <a
                            class="dropdown-item"
                            href="http://twitter.com/share?text=%D8%A7%D8%AE%D8%AA%D8%A8%D8%A7%D8%B1+%D8%AA%D8%AC%D8%B1%D9%8A%D8%A8%D9%8A&url=https://bestetheorie.nl/exam-result.php?id=9280&hashtags=Theorie+examen.%2CCBR+%2Ctheorie+oefenen%2C%D9%85%D8%A7%D8%AC%D8%AF+%D8%A7%D9%84%D8%B9%D8%A8%D9%8A%D8%AF%D9%8A+%2C%D8%A8%D8%A7%D9%82%D8%A7%D8%AA+%D9%86%D8%B8%D8%B1%D9%8A+%2C%D8%A8%D8%A7%D9%82%D8%A7%D8%AA+%D8%AA%D9%8A%D9%88%D8%B1%D9%8A%2C%D9%85%D8%AF%D8%B1%D8%B3%D8%A9+%D8%AA%D8%B9%D9%84%D9%8A%D9%85+%D8%B3%D9%8A%D8%A7%D9%82%D8%A9+%D8%B9%D8%B1%D8%A8%D9%8A%D8%A9%2C%D8%AF%D8%B1%D9%88%D8%B3+%D9%86%D8%B8%D8%B1%D9%8A+%D8%B9%D8%B1%D8%A8%D9%8A%2C%D8%AA%D8%B9%D9%84%D9%8A%D9%85+%D8%B3%D9%8A%D8%A7%D9%82%D8%A9+%D8%A8%D8%A7%D9%84%D9%84%D8%BA%D8%A9+%D8%A7%D9%84%D8%B9%D8%B1%D8%A8%D9%8A%D8%A9%2C%D8%AA%D8%B9%D9%84%D9%8A%D9%85+%D8%B3%D9%88%D8%A7%D9%82%D8%A9%2CMajed+Alobeidy"
                            target="_blank"
                            ><i class="fab fa-twitter"></i> Twitter</a
                        >
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" id="copy_url"
                            ><i class="fa fa-copy"></i> Copy</a
                        >
                    </li>
                </ul>
            </div>
        </div>
        <!-- Single Exam End -->
        <div
            class="position-absolute bottom-0 w-100 toast-holder"
            style="z-index: 11; display: none"
        >
            <div
                aria-live="polite"
                aria-atomic="true"
                class="position-relative bd-example-toasts"
            >
                <div
                    class="toast-container position-absolute mt-5 p-3 bottom-0 start-50 translate-middle-x"
                    id="toastPlacement"
                >
                    <div
                        id="liveToast"
                        class="toast align-items-center text-white bg-primary border-0"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true"
                    >
                        <div class="toast-body">
                            <i class="fa fa-check-square"></i> تم نسخ الرابط ،
                            يمكنك مشاركته الان!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scodped>
@import "./bootstrap.min.css";
@import "./style.css";
@import "./style-ar.css";

.student-info .info {
    list-style: none;
}
.student-info .info li > span:first-child {
    width: 200px;
    display: inline-block;
    padding-bottom: 10px;
}
</style>
