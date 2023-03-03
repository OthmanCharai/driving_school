<script setup>
import InvoiceEditable from "@/views/apps/invoice/InvoiceEditable.vue";

// Store
import { useInvoiceStore } from "@/views/apps/invoice/useInvoiceStore";

const invoiceListStore = useInvoiceStore();
const route = useRoute();
const invoiceData = ref({
    type: "options",
    question: "Suscipit cumque vel et.",
    voice: "Quod voluptatem accusamus aut cum.",
    sub_exam_id: 20,
    options: [
        {
            id: 413,
            answer: "Et quia facere.",
        },
        {
            id: 414,
            answer: "Ut odit odio id.",
        },
        {
            id: 415,
            answer: "Qui ut sit.",
        },
        {
            id: 416,
            answer: "Saepe non.",
        },
    ],
    image: "https:\/\/via.placeholder.com\/500x500.png\/00eecc?text=inventore",
});

// 👉 fetchInvoice
invoiceListStore
    .fetchInvoice(Number(route.params.id))
    .then((response) => {
        // invoiceData.value = {
        //     invoice: response.data.invoice,
        //     paymentDetails: response.data.paymentDetails,
        //     purchasedProducts: [
        //         {
        //             title: "App Design",
        //             cost: 24,
        //             hours: 2,
        //             description: "Designed UI kit & app pages.",
        //         },
        //     ],
        //     note: "It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!",
        //     paymentMethod: "Bank Account",
        //     salesperson: "Tom Cook",
        //     thanksNote: "Thanks for your business",
        // };
    })
    .catch((error) => {
        console.log(error);
    });
</script>

<template>
    <VRow>
        <!-- 👉 InvoiceEditable   -->
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
                        color="secondary"
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
