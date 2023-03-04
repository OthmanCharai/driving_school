<script setup>
import InvoiceEditable from "@/views/apps/invoice/InvoiceEditable.vue";
import axios from "@axios";
import { onMounted } from "vue";

const route = useRoute();
const router = useRouter();
const questionData = ref(null);

onMounted(async () => {
    let { data: question } = await axios.get(
        `/question/${1 || route.params.id}` //TODO CHANGE
    );
    //TODO CHANGE
    questionData.value = {
        ...question,
        score: question.score || 1,
        type: "dropzones",
    };
});

const updateQuestion = async () => {
    try {
        await axios.put(
            `/question/${route.params.id}` //TODO CHANGE
        );
    } catch (e) {}
    router.push({ name: "admin-invoice-list" });
};
</script>

<template>
    <VRow v-if="questionData">
        <!-- 👉 InvoiceEditable   -->
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
                        color="secondary"
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
                    <VBtn block ariant="tonal" @click="updateQuestion">
                        Save
                    </VBtn>
                </VCardText>
            </VCard>
        </VCol>
    </VRow>
</template>
