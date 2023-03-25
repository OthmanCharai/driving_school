<script setup>
import { ref } from "vue";
const props = defineProps({
    question: {
        type: null,
        required: true,
    },
});

// const question = toRefs(props);
// const images = ref([]);
const images = computed({
    get: () => props.question.images || [],
    set: (newValue) => {
        if (!props.question.images) props.question.images = [];
        console.log(newValue);
        props.question.images = newValue; //; props.question.images.concat(newValue);
        // console.log(props.question.images);
    },
});

const imagesInputs = ref([]);

const uploadAvatar = (avatarInputIndex) => {
    const uploadedFiles =
        imagesInputs.value[avatarInputIndex - 1 - images.value.length].files;
    // images.value =
    images.value.push(uploadedFiles);
    // userService.uploadimages(uploadedFiles);
};

const removeImage = (avatarInputIndex) => {
    images.value.splice(avatarInputIndex, 1);
};

const selectImage = (avatarInputIndex) => {
    props.question.answer_image_index = avatarInputIndex;
};

const getImg = (avatar) => {
    if (!avatar.url) {
        console.log({ avatar });
        let [file] = avatar;
        console.log({ file });
        if (file) return URL.createObjectURL(file);
    } else {
       return avatar.url
    }
};
</script>
<template>
    <div class="px-2">
        <label class="block text-xl mt-4 font-medium text-gray-700"
            >Question Options</label
        >
        <div class="flex flex-wrap gap-6 max-w-[60rem] mt-4">
            <div
                v-for="avatarInputIndex in 3"
                class="relative mt-1 flex-1 h-[20rem] min-w-[30%] flex justify-center items-center rounded-md border-dashed border-slate-300 bg-[#EAEDF6]"
                :class="{ 'border-2': !images[avatarInputIndex - 1] }"
            >
                <template v-if="images[avatarInputIndex - 1]">
                    <!-- {{ question.answer_image_index }} -->
                    <!-- {{ avatarInputIndex - 1 }} -->
                    <div
                        @click="selectImage(avatarInputIndex - 1)"
                        class="w-full h-full border-6 bordDer-transparent border-blue-700"
                        :class="{
                            ' !border-blue-700':
                                question.answer_image_index ==
                                avatarInputIndex - 1,
                        }"
                    >
                        <img
                            class="w-full h-full rounded-md object-cover"
                            :src="getImg(images[avatarInputIndex - 1])"
                        />
                    </div>
                </template>

                <label
                    v-if="!images[avatarInputIndex - 1]"
                    class="cursor-pointer rounded-md font-medium focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2"
                >
                    <div class="space-y-1 text-center">
                        <div
                            class="bg-red-500 rounded-full w-8 h-8 flex justify-center items-center absolute -bottom-2 -right-4"
                        >
                            <svg
                                for="file-upload"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"
                                fill="#fff"
                                class="w-6 h-6"
                            >
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"
                                />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-500">
                            <input
                                ref="imagesInputs"
                                :id="`file-upload-${avatarInputIndex}`"
                                :name="`file-upload-${avatarInputIndex}`"
                                type="file"
                                class="sr-only"
                                @change="uploadAvatar(avatarInputIndex)"
                            />
                        </p>
                    </div>
                </label>
                <label
                    v-if="images[avatarInputIndex - 1]"
                    class="cursor-pointer rounded-md font-medium focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2"
                >
                    <div class="space-y-1 text-center">
                        <div
                            @click="removeImage(avatarInputIndex - 1)"
                            class="bg-red-500 rounded-full w-8 h-8 flex justify-center items-center absolute -bottom-2 -right-4"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="white"
                                class="h-6 w-6"
                            >
                                <path
                                    d="M13.41,12l6.3-6.29a1,1,0,1,0-1.42-1.42L12,10.59,5.71,4.29A1,1,0,0,0,4.29,5.71L10.59,12l-6.3,6.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l6.29,6.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"
                                />
                            </svg>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
</template>
