<template lang="">
    <!--======= ITEM 1 =========-->
    <li class="col-sm-6 col-md-3">
        <div class="prodct">
            <!--======= IMAGE =========-->
            <img class="img-responsive" :src="exam.image" alt="" />
            <span class="c-date"
                >{{ (exam.users_count)?exam.users_count:0 }} <br />
                {{ $t('words.landing.user') }}</span
            >
            <span class="c-like"><i class="fa fa-heart"></i></span>
            <div class="pro-info">
                <!--======= ITEM NAME / RATING =========-->
                <div class="cate-name">
                    <span class="pull-left badge " :class="{'badge-success':exam.is_free,'badge-primary':!exam.is_free}">{{ (exam.is_free)?$t('words.landing.free'):$t('words.landing.not-free') }}</span>
                 <!--    <ul class="stars pull-right">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li class="no-rate"><i class="fa fa-star"></i></li>
                    </ul> -->
                </div>

                <!--======= ITEM Details =========-->
                <a href="#.">{{ exam.name }}</a>
                <hr />
                <router-link  class="btn" :to="{name:'exam',params:{id:exam.id}}">{{ $t('words.landing.start-exam') }}</router-link>
                
                
            </div>
        </div>
    </li>
</template>
<script setup>
const props=defineProps([
    "users_count",
    "exam"
]);
</script>
<style lang=""></style>
