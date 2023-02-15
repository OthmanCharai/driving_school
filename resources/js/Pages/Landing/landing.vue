<template lang="">
    <div id="wrap" class="wide"> 
        
        <top-bar></top-bar>
   <!--======= HEADER =========-->
        <LandingHeader />
        <banner></banner>
        <content></content>
        <FooterVue></FooterVue>
    </div>
</template>
<script setup>
import Content from '../../Components/Landing/content.vue';
import Banner from "../../Components/Landing/banner.vue";
import LandingHeader from '../../Components/Landing/header.vue';
import topBar from '../../Components/Landing/top-bar.vue';
import FooterVue from '../../Components/Landing/footer.vue'


</script>
<style lang="css" >
#nav-res{
    background: white;
}
    
</style>