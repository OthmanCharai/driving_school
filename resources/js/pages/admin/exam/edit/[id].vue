<script setup>
import examEditable from "@/views/apps/exam/examEditable.vue";
import axios from "@axios";
import { onMounted } from "vue";

const route = useRoute();
const router = useRouter();
const questionData = ref(null);

onMounted(async () => {
    let { data: question } = await axios.get(`/exam/${route.params.id}`);
    questionData.value = question;
});

const updateQuestion = async () => {
    try {
        await axios.put(`/exam/${route.params.id}`, questionData.value);
    } catch (e) {}
    router.push({ name: "admin-exam-list" });
};
</script>

<template>
    <VRow v-if="questionData">
        <!-- 👉 InvoiceEditable   -->
        <VCol cols="12" md="9">
            <examEditable :data="questionData" />
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
                            name: 'admin-question-preview-id',
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
