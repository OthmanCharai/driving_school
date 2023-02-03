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
                                        <li class="dropdown active"> <a href="index.html" class="dropdown-toggle">Home </a></li>
                                        <li><a href="#feature">Features</a></li>
                                        <li class="dropdown"> <a href="#products" class="dropdown-toggle">Courses </a></li>
                                        <li class="dropdown"> <a href="#portfolio" class="dropdown-toggle">Gallery </a>   </li>
                                        <li class="dropdown"> <a href="#video" class="dropdown-toggle">Specials </a></li>
                                        <li class="dropdown"> <a href="#pricing" class="dropdown-toggle">Pricing </a></li>                        
                                        <li class="dropdown"> <a href="#inspectors" class="dropdown-toggle">Instructors</a></li>
                                        <li class="dropdown"> <a href="#news" class="dropdown-toggle">Faq </a></li>                                        
                                        <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle">Blog  <b class="caret"></b> </a>
                                            <ul class="dropdown-menu animated-half fadeInUp">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog-single.html">Blog Single</a></li>
                                                <li><a href="blog-left-side-bar.html">Blog Left Bar</a></li>
                                                <li><a href="blog-single-left-side-bar.html">Blog Single Left Bar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#quote">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            
           <banner></banner>
        <content></content>
    </div>
</template>
<script setup>
import Content from './content.vue';
import Banner from "./banner.vue";
import LandingHeader from './header.vue';
import topBar from './top-bar.vue';

</script>
<style lang="css" >
#nav-res{
    background: white;
}
    
</style>