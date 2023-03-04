<script setup>
import InvoiceEditable from "@/views/apps/invoice/InvoiceEditable.vue";

const invoiceData = ref({
    type: "dropzones",
    question: "Suscipit cumque vel et.",
    voice: "Quod voluptatem accusamus aut cum.",
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

const paymentTerms = ref(true);
const clientNotes = ref(false);
const paymentStub = ref(false);
const selectedPaymentMethod = ref("Bank Account");

const paymentMethods = ["Bank Account", "PayPal", "UPI Transfer"];
</script>

<template>
    <VRow>
        <!-- 👉 InvoiceEditable -->
        <VCol cols="12" md="9">
            <InvoiceEditable :data="invoiceData" />
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
                        class="mb-2"
                        :to="{
                            name: 'admin-invoice-preview-id',
                            params: { id: '5036' },
                        }"
                    >
                        Preview
                    </VBtn>

                    <!-- 👉 Save -->
                    <VBtn block color="default" variant="tonal"> Save </VBtn>
                </VCardText>
            </VCard>
        </VCol>
    </VRow>
</template>
