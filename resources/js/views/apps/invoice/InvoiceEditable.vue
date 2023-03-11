<script setup>
import { requiredValidator } from "@validators";
import axios from "@axios";
import DropzonesQuestion from "./DropzonesQuestion.vue";

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

const deleteOption = (optionIndex) => {
    props.data.options.splice(optionIndex, 1);
};
const addAnOption = (optionIndex) => {
    props.data.options.push({
        answer: "",
        status:false
    });
};

const getRightAnswer = () =>
    props.data.options.find((option) => option.status === true) ||
    props.data.options[0];

const updateOptionStatus = (optionId, newStatusValue) => {
    const optionToUpdate = props.data.options.find(
        (option) => option.answer === optionId
    );

    if (optionToUpdate) {
        optionToUpdate.status = newStatusValue;
    }
};

const selectedOption = computed({
    get: () => getRightAnswer(),
    set: (newAnswerTitle) => {
        updateOptionStatus(getRightAnswer().answer, false);
        updateOptionStatus(newAnswerTitle, true);
    },
});

const changeImage = (file) => {
    const fileReader = new FileReader();
    const { files } = file.target;
    if (files && files.length) {
        const uploadedFile = files[0];
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
    subExamsList.value = data.data;
});

const selectedSubExam = computed({
    get: () =>
        subExamsList.value.find((subExam) => subExam.id === props.data.sub_exam_id) ||
        null,
    set: (newOptionID) => {
        props.data.sub_exam_id = newOptionID;
    },
});
</script>

<template>
    <VCard>
        <VDivider />

        <VForm ref="refForm" @submit.prevent="() => {}" class="p-8">
            <VCol cols="12" md="6">
                <VTextField
                    v-model="data.question"
                    label="Question Title"
                    :rules="[requiredValidator]"
                />
            </VCol>
            <VCol cols="6">
                <VSelect
                    v-model="data.type"
                    :items="['options', 'dropzones']"
                    label="Type"
                    persistent-placeholder
                />
            </VCol>
            <VCol cols="6">
                <VSelect
                    v-model="selectedSubExam"
                    :items="subExamsList"
                    item-title="name"
                    item-value="id"
                    label="Attach to a sub Exam"
                    persistent-placeholder
                    :menu-props="{ maxHeight: '200' }"
                />
            </VCol>
            <VDivider />
            <div v-if="data.type !== 'dropzones'">
                <!-- <VRow> -->
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

                <h4 class="my-4">Options</h4>
                <VRow>
                    <VCol
                        v-for="(option, index) of data.options"
                        cols="12"
                        md="6"
                    >
                        <VTextField
                            v-model="data.options[index].answer"
                            label="Option"
                            :rules="[requiredValidator]"
                            append-inner-icon="tabler-x"
                            @click:append-inner="deleteOption(index)"
                        />
                    </VCol>
                </VRow>
                <div class="mt-4">
                    <VBtn @click="addAnOption"> Add an Option </VBtn>
                </div>
                <VCol cols="6" class="m-0 p-0">
                    <VSelect
                        v-model="selectedOption"
                        class="p-0 m-0 mt-4"
                        :items="data.options"
                        label="Choose the right answer"
                        item-title="answer"
                        item-value="id"
                    />
                </VCol>
            </div>
            <DropzonesQuestion :question="data" v-else />
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
