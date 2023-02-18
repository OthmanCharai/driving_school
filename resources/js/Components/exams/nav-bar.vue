<template lang="">
    <div class="exam-nav">
        <nav class="navbar bg-primary">
            <div class="container-fluid">
                <button
                    class="btn btn-secondary p-3"
                    id="end_quiz"
                    type="submit"
                >
                    إنهاء الاختبار
                </button>
                <button
                    class="btn btn-secondary p-2 text-end mx-5 text-center"
                    type="button"
                >
                    الوقت المتبقي
                    <span class="bg-primary mx-1 p-1" id="timer">0</span>
                </button>
            </div>
        </nav>
    </div>
</template>
<script>
export default {};
</script>
<style>

</style>
