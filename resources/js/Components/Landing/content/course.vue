<template lang="">
      <!--======= RESPONSIVE FORM =========-->
      <div class="visible-xs" id="find-course">
                    <div class="container">
                        <div class="col-xs-12">
                            <div class="find-drive">
                                <h5>Find Driving Course <i class="fa fa-road"></i></h5>
                                <div class="drive-form">
                                    <div class="intres-lesson"> 

                                        <!--======= FORM =========-->
                                        <form role="form" id="find_course" method="post">
                                            <ul class="row">

                                                <!--======= INPUT NAME =========-->
                                                <li class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" title="" data-original-title="" class="form-control" id="name" name="Name" placeholder="Your Name">
                                                        <span class="fa fa-user"></span> </div>
                                                </li>

                                                <!--======= INPUT EMAIL =========-->
                                                <li class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="email" title="" data-original-title="" class="form-control" id="email" placeholder="Your Email">
                                                        <span class="fa fa-envelope"></span> </div>
                                                </li>

                                                <!--======= INPUT PHONE NUMBER =========-->
                                                <li class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" title="" data-original-title="" class="form-control" id="phone" placeholder="Phone">
                                                        <span class="fa fa-phone"></span> </div>
                                                </li>

                                                <!--======= INPUT PHONE NUMBER =========-->
                                                <li class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" title="" data-original-title="" name="datepicker" class="form-control hasDatepicker" id="datepicker" placeholder="DD/MM/YY">
                                                        <span class="fa fa-calendar"></span> </div>
                                                </li>

                                                <!--======= INPUT SELECT =========-->
                                                <li class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="select1">
                                                            <option>Course Type</option>
                                                            <option>Course Type 1</option>
                                                            <option>Course Type 2</option>
                                                            <option>Course Type 3</option>
                                                        </select>
                                                        <span class="fa fa-file-text-o"></span> </div>
                                                </li>

                                                <!--======= INPUT SELECT =========-->
                                                <li class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="select2">
                                                            <option>Car Type</option>
                                                            <option>Car Type 1</option>
                                                            <option>Car Type 2</option>
                                                            <option>Car Type 3</option>
                                                        </select>
                                                        <span class="fa fa-car"></span> </div>
                                                </li>

                                                <!--======= INPUT SELECT =========-->
                                                <li class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="select3">
                                                            <option>Time</option>
                                                            <option>Time 1</option>
                                                            <option>Time 2</option>
                                                            <option>Time 3</option>
                                                        </select>
                                                        <span class="fa fa-clock-o"></span> </div>
                                                </li>
                                            </ul>

                                            <!--======= BUTTON =========-->
                                            <div class="text-center">
                                                <button type="submit" value="submit" class="btn" id="btn_submit">Find MY Course</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</template>
<script setup>

</script>
<style lang="">
    
</style>