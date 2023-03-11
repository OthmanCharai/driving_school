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

const subExamsList = ref([]);

onMounted(async () => {
    const { data } = await axios.get("/exam");
    console.log(data.data.data);
    subExamsList.value = data.data.data;
});

const selectedSubExam = computed({
    get: () =>
        subExamsList.value.find(
            (subExam) => subExam.id === props.data.exam_id
        ) || null,
    set: (newOptionID) => {
        props.data.exam_id = newOptionID;
    },
});
</script>

<template>
    <VCard>
        <VDivider />

        <VForm ref="refForm" @submit.prevent="() => {}" class="p-8">
            <VCol cols="12" md="6">
                <VTextField
                    v-model="data.name"
                    label="Sub Exam Title"
                    :rules="[requiredValidator]"
                />
            </VCol>
            <VRow class="px-3 py-4">
                <VCol cols="6">
                    <VTextField
                        v-model="data.note"
                        label="Minimum Score"
                        type="number"
                        :rules="[requiredValidator]"
                    />
                </VCol>
                <VCol cols="6">
                    <VSelect
                        v-model="selectedSubExam"
                        :items="subExamsList"
                        item-title="name"
                        item-value="id"
                        label="Attach to an exam"
                        persistent-placeholder
                        :menu-props="{ maxHeight: '200' }"
                    />
                </VCol>
            </VRow>
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
