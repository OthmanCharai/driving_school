<template lang="">
    <!--======= BANNER =========-->
    <div class="sub-banner">
        <div class="container">
           
            <ul class="links">
                <li>
                    <router-link to="/">Home</router-link>
                    /
                </li>
                <li>
                    <router-link to="/{{ path }}">{{ path }}</router-link>

                    </li>
            </ul>
        </div>
    </div>
</template>
<script setup>

const props = defineProps([
    'title',
    "path"
])


</script>
<style lang=""></style>
