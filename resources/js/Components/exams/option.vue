<template lang="">
    <div class="alert" @click="changeSelected(option.id)">
        {{ option.answer }}
        <input type="hidden" :value="option.id">
    </div>
</template>

<script setup>
import { ref, props } from 'vue';
const props=defineProps(['option']);

// changed options
const changeSelected=(id)=>{

}

</script>
<style lang="">
    
</style>