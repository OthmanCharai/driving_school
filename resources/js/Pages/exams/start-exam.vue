<template lang="">
    <div class="full-height">
        <exam-nav-barre></exam-nav-barre>
        <div class="full-height" >
            <hr>
            <div class="big-month">  {{ exam.data.name }} </div>
            <hr>

        </div>
        <exam-footer></exam-footer>        
    </div>
</template>
<script setup>
import ExamNavBarre from "./../../Components/exams/nav-bar.vue";
import ExamFooter from "./../../Components/exams/footer.vue";
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import useExam from "./../../composables/exams";
const {exam,getExam}=useExam();

const route=useRoute();
onMounted(()=>{
    getExam(route.params.id);
    
   
})

</script>
<style>
  .full-height {
    height: 100vh;
  }

</style>