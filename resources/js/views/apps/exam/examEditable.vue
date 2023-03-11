<script setup>
import { requiredValidator } from "@validators";
import axios from "@axios";

const props = defineProps({
    data: {
        type: null,
        required: true,
    },
});

const refForm = ref();

const iamgeRules = [
    (fileList) =>
        !fileList ||
        !fileList.length ||
        fileList[0].size < 2e6 ||
        "Image size should be less than 2 MB!",
];


const options = [
    { label: "paid", value: 0 },
    { label: "free", value: 1 },
];

const selectedOption = computed({
    get: () => options[props.data.is_free]?.label,
    set: (newAnswerTitle) => {
        props.data.is_free = newAnswerTitle
    },
});

const changeImage = (file) => {
    const fileReader = new FileReader();
    const { files } = file.target;
    if (files && files.length) {
        const uploadedFile = files[0];
        console.log(uploadedFile)
        props.data.image = uploadedFile;
        fileReader.readAsDataURL(files[0]);
        fileReader.onload = () => {
            if (typeof fileReader.result === "string")
                props.data.image_screenshot = fileReader.result;
        };
    }
};

const subExamsList = ref([]);

onMounted(async () => {
    const { data } = await axios.get("/sub-exam");
    subExamsList.value = data;
});
</script>

<template>
    <VCard>
        <VDivider />

        <VForm ref="refForm" @submit.prevent="() => {}" class="p-8">
            <VCol cols="12" md="6">
                <VTextField
                    v-model="data.name"
                    label="Exam Title"
                    :rules="[requiredValidator]"
                />
            </VCol>
            <VCol cols="6">
                <VSelect
                    v-model="selectedOption"
                    :items="options"
                    label="Type"
                    item-title="label"
                    item-value="value"
                    persistent-placeholder
                />
            </VCol>
            <VDivider />
            <VCol cols="12" md="6">
                <VFileInput
                    :rules="iamgeRules"
                    label="Question Image"
                    accept="image/png, image/jpeg, image/bmp"
                    placeholder="Pick an avatar"
                    prepend-icon="tabler-camera"
                    @input="changeImage"
                />
            </VCol>
            <div class="h-[25rem] !w-[70%]">
                <img
                    v-if="data.image_screenshot"
                    :src="data.image_screenshot"
                    class="h-full w-full rounded-md"
                />
            </div>
        </VForm>

        <VDivider />
    </VCard>
</template>

<style>
input,
input:focus {
    border: none;
    outline: none;
}
</style>
