<template lang="">
    <!--======= BANNER =========-->
    <div id="banner">
        <div class="">
            <ul class="">
                <!--======= SLIDE 1 =========-->
                <li>
                    <img  src="https://media.gettyimages.com/id/181048438/fr/photo/maroc-dans-une-mosqu%C3%A9e.jpg?s=612x612&w=gi&k=20&c=Ahq7S3qxdrl2CHhUwOnHUpA5ICz8yIc4N_oZ5IhM-Dw=" class="fluid" style="height:830px" alt="" />
                    <div class="container">
                        <div class="text-slider">
                            <div class="col-sm-7">
                                <h3>
                                    Save Your MOney Book Your Lesson
                                    <i class="fa fa-long-arrow-left"></i>
                                </h3>
                                <p>
                                    Proin gravida nibh vel velit auctor aliquet.
                                    Aenean sollicitudin, lorem quis bibendum
                                    auctor.
                                </p>
                                <a class="btn" href="08_booking_page.html"
                                    >Book lesson</a
                                >
                                <a
                                    class="btn btn-1 get-form"
                                    href="javascript:void(0)"
                                    >Get A Code</a
                                >
                            </div>
                            <div class="col-sm-5 col-md-4 pull-left hidden-xs">
                                <div class="find-drive">
                                    <h5>
                                        Find Driving Course
                                        <i class="fa fa-road"></i>
                                    </h5>
                                    <div class="drive-form">
                                        <div class="intres-lesson">
                                            <!--======= FORM =========-->
                                            <form
                                                role="form"
                                                id="find_course"
                                                method="post"
                                            >
                                                <ul class="row">
                                                    <!--======= INPUT NAME =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="name"
                                                                name="Name"
                                                                placeholder="Your Name"
                                                            />
                                                            <span
                                                                class="fa fa-user"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT EMAIL =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="email"
                                                                class="form-control"
                                                                id="email"
                                                                placeholder="Your Email"
                                                            />
                                                            <span
                                                                class="fa fa-envelope"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT PHONE NUMBER =========-->
                                                    <li class="col-sm-12">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="phone"
                                                                placeholder="Phone"
                                                            />
                                                            <span
                                                                class="fa fa-phone"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT PHONE NUMBER =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <input
                                                                type="text"
                                                                name="datepicker"
                                                                class="form-control"
                                                                id="datepicker"
                                                                placeholder="DD/MM/YY"
                                                            />
                                                            <span
                                                                class="fa fa-calendar"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select1"
                                                            >
                                                                <option>
                                                                    Course Type
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    1
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    2
                                                                </option>
                                                                <option>
                                                                    Course Type
                                                                    3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-file-text-o"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select2"
                                                            >
                                                                <option>
                                                                    Car Type
                                                                </option>
                                                                <option>
                                                                    Car Type 1
                                                                </option>
                                                                <option>
                                                                    Car Type 2
                                                                </option>
                                                                <option>
                                                                    Car Type 3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-car"
                                                            ></span>
                                                        </div>
                                                    </li>

                                                    <!--======= INPUT SELECT =========-->
                                                    <li class="col-sm-6">
                                                        <div class="form-group">
                                                            <select
                                                                id="select3"
                                                            >
                                                                <option>
                                                                    Time
                                                                </option>
                                                                <option>
                                                                    Time 1
                                                                </option>
                                                                <option>
                                                                    Time 2
                                                                </option>
                                                                <option>
                                                                    Time 3
                                                                </option>
                                                            </select>
                                                            <span
                                                                class="fa fa-clock-o"
                                                            ></span>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <!--======= BUTTON =========-->
                                                <div class="text-center">
                                                    <button
                                                        type="submit"
                                                        value="submit"
                                                        class="btn"
                                                        id="btn_submit"
                                                    >
                                                        Find MY Course
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <!--======= SLIDE 2 =========-->
               
            </ul>
        </div>
    </div>
</template>
<script setup>

</script>
<style lang=""></style>
