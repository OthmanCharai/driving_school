<template lang="">
    <!--======= HEADER =========-->
    <header class="sticky">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="row">
                    <div class="navbar-header col-md-3 col-sm-3">
                        <button
                            type="button"
                            class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#nav-res"
                        >
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-navicon"></span>
                        </button>
                        <!--======= LOGO =========-->
                        <div class="logo">
                            <a class="theme-title" href="javascript:void(0)">
                                <span class="fa-stack">
                                    <i class="fa logo-hex fa-stack-2x"></i>
                                    <i
                                        class="fa logo-fa fa-road fa-stack-1x"
                                    ></i>
                                </span>
                                Drive Me
                            </a>
                        </div>
                    </div>

                    <!--======= MENU =========-->
                    <div class="col-md-9 col-sm-9">
                        <div class=" navbar-collapse" id="nav-res">
                            <ul class="nav navbar-nav">
                                <li class="dropdown active">
                                    <router-link :to="{name:'home'}">
                                        {{ $t("words.landing.home") }}
                                    </router-link>
                                   
                                </li>
                                <li class="dropdown">
                                    <router-link :to="{name:'exams'}">
                                        {{ $t("words.landing.exams") }}
                                    </router-link>
                                  
                                </li>
                                <li class="dropdown">
                                    <a href="#portfolio" class="dropdown-toggle"
                                        >{{ $t("words.landing.about-us") }}
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#pricing" class="dropdown-toggle"
                                        >{{ $t("words.landing.contact") }}
                                    </a>
                                </li>
                                <!--                                         <li class="dropdown"> <a href="#inspectors" class="dropdown-toggle">{{ $t('words.landing.login') }}</a></li>
 -->
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>
<script setup></script>
<style lang="css" scoped></style>
