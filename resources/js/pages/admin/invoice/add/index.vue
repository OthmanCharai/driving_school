<script setup>
import InvoiceEditable from "@/views/apps/invoice/InvoiceEditable.vue";
import axios from "@axios";

const questionData = ref({
    type: "dropzones",
    question: "Suscipit cumque vel et.",
    sub_exam_id: 20,
    score: 1,
    options: [
        {
            id: 413,
            answer: "Et quia facere.",
            status: false,
        },
        {
            id: 414,
            answer: "Ut odit odio id.",
            status: false,
        },
        {
            id: 415,
            answer: "Qui ut sit.",
            status: true,
        },
        {
            id: 416,
            answer: "Saepe non.",
            status: false,
        },
    ],
    image: null,
});

const saveQuestion = async () => {
    // apiClient.
    axios.post("/question", questionData.value);
};
</script>

<template>
    <VRow>
        <!-- 👉 InvoiceEditable -->
        <VCol cols="12" md="9">
            <InvoiceEditable :data="questionData" />
        </VCol>

        <!-- 👉 Right Column: Invoice Action -->
        <VCol cols="12" md="3">
            <VCard class="mb-8">
                <VCardText>
                    <!-- 👉 Preview -->
                    <VBtn
                        block
                        color="default"
                        variant="tonal"
                        disabled="true"
                        class="mb-2"
                        :to="{
                            name: 'admin-invoice-preview-id',
                            params: { id: '5036' },
                        }"
                    >
                        Preview
                    </VBtn>

                    <!-- 👉 Save -->
                    <VBtn block @click="saveQuestion"> Save </VBtn>
                </VCardText>
            </VCard>
        </VCol>
    </VRow>
</template>
