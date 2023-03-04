<script setup>
import { useInvoiceStore } from "./useInvoiceStore";
import { requiredValidator } from "@validators";
import DropzonesQuestion from "./DropzonesQuestion.vue";

const props = defineProps({
    data: {
        type: null,
        required: true,
    },
});

// const { data } = toRefs(props);

// const invoiceListStore = useInvoiceStore();

// 👉 Clients
// const clients = ref([]);

// // 👉 fetchClients
// invoiceListStore
//     .fetchClients()
//     .then((response) => {
//         clients.value = response.data;
//     })
//     .catch((err) => {
//         console.log(err);
//     });

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
    });
};

const getRightAnswer = () =>
    props.data.options.find((option) => option.status === true) ||
    props.data.options[0];

const updateOptionStatus = (optionId, newStatusValue) => {
    const optionToUpdate = props.data.options.find(
        (option) => option.id === optionId
    );

    if (optionToUpdate) {
        optionToUpdate.status = newStatusValue;
    }
};

const selectedOption = computed({
    get: () => getRightAnswer(),
    set: (newOptionID) => {
        updateOptionStatus(getRightAnswer().id, false);
        updateOptionStatus(newOptionID, true);
    },
});

const changeImage = (file) => {
    const fileReader = new FileReader();
    const { files } = file.target;
    if (files && files.length) {
        fileReader.readAsDataURL(files[0]);
        fileReader.onload = () => {
            if (typeof fileReader.result === "string")
                props.data.image = fileReader.result;
        };
    }
};
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
            <VCol cols="1" mdd="6">
                <VTextField
                    v-model="data.score"
                    type="number"
                    label="Question Score"
                    :rules="[requiredValidator]"
                />
            </VCol>
            <VCol cols="3">
                <VSelect
                    v-model="data.type"
                    :items="['order', 'dropzones']"
                    label="Type"
                    persistent-placeholder
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
                        v-if="data.image"
                        :src="data.image"
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
                            label="Answer"
                            :rules="[requiredValidator]"
                            append-inner-icon="tabler-x"
                            @click:append-inner="deleteOption(index)"
                        />
                    </VCol>
                </VRow>
                <div class="mt-4">
                    <VBtn @click="addAnOption"> Add an Option </VBtn>
                </div>
                <VCol cols="3" class="m-0 p-0">
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
