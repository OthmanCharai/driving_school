<script setup>
import { remove } from "@vue/shared";
import { ref } from "vue";
const props = defineProps({
    question: {
        type: null,
        required: true,
    },
});

// const question = toRefs(props);
const originalQuestion = JSON.parse(JSON.stringify(props.question));
// const images = ref([]);
const images = computed({
    get: () => props.question.images || [],
    set: (newValue) => {
        if (!props.question.images) props.question.images = [];
        console.log(newValue);
        props.question.images.push(newValue);
    },
});

const updatedImages = computed({
    get: () => props.question.updatedImages || [],
    set: (newValue) => {
        if (!props.question.updatedImages) props.question.updatedImages = [];
        // console.log(newValue)
        props.question.updatedImages = newValue;
        // console.log(newValue, props.question.updatedImages);
    },
});

const imagesInputs = ref([]);

const uploadAvatar = (avatarInputIndex) => {
    const index = avatarInputIndex - 1;
    const uploadedFiles = imagesInputs.value[index]?.files;
    let [file] = uploadedFiles;
    const uuid = Date.now() + Math.random().toString(36).substring(2);
    file.uuid = uuid;
    console.log({ index, uploadedFiles });
    // images.value =
    images.value.push(uploadedFiles);
    // const id = originalQuestion.images[avatarInputIndex - 1]?.id;
    updatedImages.value.push({
        uuid,
        status: false,
        image: uploadedFiles[0],
    });
    // userService.uploadimages(uploadedFiles);
};

function removeUploadedImage(avatarInputIndex) {
    const removedImage = images.value[avatarInputIndex];
    if (removedImage?.id) {
        props.question.removedImages.push(removedImage.id);
        return;
    }
    const uuid = removedImage[0]?.uuid;
    console.log(images.value[avatarInputIndex][0]?.uuid, { avatarInputIndex });
    if (uuid === undefined) {
        return;
    }
    const index = updatedImages.value.findIndex((image) => image.uuid === uuid);
    console.log({ index });
    if (index !== -1) {
        updatedImages.value.splice(index, 1);
    }
}

const removeImage = (avatarInputIndex) => {
    removeUploadedImage(avatarInputIndex);
    images.value.splice(avatarInputIndex, 1);
};

const selectImage = (avatarInputIndex) => {
    props.question.answer_image_index = avatarInputIndex;
};

const getImg = (avatar) => {
    if (!avatar.url) {
        let [file] = avatar;
        if (file) return URL.createObjectURL(file);
    } else {
        return avatar.url;
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
                class="cursor-pointer border-[5px] relative mt-1 flex-1 h-[20rem] min-w-[30%] flex justify-center items-center rounded-md border-transparent bg-[#bcbfc8]"
                :class="{
                    'border-4 border-dashed': !images[avatarInputIndex - 1],
                    ' border-[5px] !border-blue-800 !border-solid':
                    images[avatarInputIndex - 1] && question.answer_image_index == avatarInputIndex - 1,
                }"
            >
                <template v-if="images[avatarInputIndex - 1]">
                    <div
                        @click="selectImage(avatarInputIndex - 1)"
                        class="w-full h-full border-6 border-blue-700"
                    >
                        <img
                            class="w-full h-full rounded-md object-cover border-2 border-blue-400"
                            :src="getImg(images[avatarInputIndex - 1])"
                        />
                    </div>
                </template>

                <label
                    v-show="!images[avatarInputIndex - 1]"
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
