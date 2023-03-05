<script setup>
import InvoiceEditable from "@/views/apps/invoice/InvoiceEditable.vue";
import axios from "@axios";

const questionData = ref({
    type: "dropzones",
    question: "",
    sub_exam_id: null,
    options: [
        {
            id: 413,
            answer: "",
        },
    ],
    image: null,
});

const saveQuestion = async () => {
    router.push({ name: "admin-invoice-list" });
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
