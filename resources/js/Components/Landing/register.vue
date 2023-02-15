<template lang="">
    <div class="drive-form">
        <div class="intres-lesson">
            <!--======= FORM =========-->
            <form role="form" id="find_course" method="post" @submit.prevent="registerUser">
                <ul class="row">
                    <!--======= INPUT NAME =========-->
                    <li class="col-sm-12">
                        <div class="form-group">
                            <input
                                type="text"
                                v-model="name"
                                class="form-control"
                                id="name"
                                name="Name"
                                placeholder="Your Name"
                            />
                            <span class="fa fa-user"></span>
                        </div>
                    </li>

                    <!--======= INPUT EMAIL =========-->
                    <li class="col-sm-12">
                        <div class="form-group">
                            <input
                                type="text"
                                v-model="email"
                                class="form-control"
                                id="email"
                                placeholder="Your Email"
                            />
                            <span class="fa fa-envelope"></span>
                        </div>
                    </li>

                    <!--======= INPUT PHONE NUMBER =========-->
                    <li class="col-sm-12">
                        <div class="form-group">
                            <input
                                v-model="password"
                                type="password"
                                class="form-control"
                                id="password"
                                placeholder="password"
                            />
                            <span class="fa fa-password"></span>
                        </div>
                    </li>
                </ul>
                <div class="text-center d-flex justify-content-around">
                    <button @click="registerUser" class="btn">
                        {{ $t("words.landing.register") }}
                    </button>
                  
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import {ref} from "vue";
const email=ref('');
const password=ref('');
const name=ref('');

// methodes 
const registerUser=async()=>{
   const response= await axios.post('api/register',{
    email:email.value,
    name:name.value,
    password:password.value,
   });
   console.log(response);
}

</script>
<style lang=""></style>
