<template lang="">
    <div id="wrap" class="wide"> 
        
        <top-bar></top-bar>
   <!--======= HEADER =========-->
   <header class="sticky">
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="row">
                            <div class="navbar-header col-md-3 col-sm-3">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-res"> <span class="sr-only">Toggle navigation</span> <span class="fa fa-navicon"></span> </button>
                                <!--======= LOGO =========-->
                                <div class="logo"> <a class="theme-title" href="javascript:void(0)"> <span class="fa-stack"> <i class="fa logo-hex fa-stack-2x"></i> <i class="fa logo-fa fa-road fa-stack-1x"></i> </span> Drive Me </a> </div>
                            </div>

                            <!--======= MENU =========-->
                            <div class="col-md-9 col-sm-9">
                                <div class="collapse navbar-collapse" id="nav-res">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown active"> <a href="index.html" class="dropdown-toggle">{{ $t('words.landing.home') }} </a></li>
                                        <li class="dropdown"> <a href="#products" class="dropdown-toggle">{{ $t('words.landing.exams') }} </a></li>
                                        <li class="dropdown"> <a href="#portfolio" class="dropdown-toggle">{{ $t('words.landing.about-us') }} </a>   </li>
                                        <li class="dropdown"> <a href="#pricing" class="dropdown-toggle">{{ $t('words.landing.contact') }} </a></li>                        
<!--                                         <li class="dropdown"> <a href="#inspectors" class="dropdown-toggle">{{ $t('words.landing.login') }}</a></li>
 -->                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
           <banner></banner>
        <content></content>
        <FooterVue></FooterVue>
    </div>
</template>
<script setup>
import Content from './content.vue';
import Banner from "./banner.vue";
import LandingHeader from './header.vue';
import topBar from './top-bar.vue';
import FooterVue from './footer.vue'

</script>
<style lang="css" >
#nav-res{
    background: white;
}
    
</style>