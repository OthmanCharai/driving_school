<template lang="">
    <footer class="question w-full h-36 fixed bottom-0 flex items-end">

        
       <div class="flex">
            <router-link
                class="btn btn-secondary"
                :to="{ name: 'question', params: { id: 1, id: 1 } }"
                >{{ $t("words.landing.next-question") }}</router-link
            >
        </div> 
    </footer>
</template>
<script setup></script>
<style>

</style>
