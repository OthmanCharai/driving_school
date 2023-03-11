<script setup>
import subExamEditable from "@/views/apps/subExam/subExamEditable.vue";
import axios from "@axios";
import { onMounted } from "vue";

const route = useRoute();
const router = useRouter();
const subExamData = ref(null);

onMounted(async () => {
    let { data: question } = await axios.get(`/sub-exam/${route.params.id}`);
    console.log(question.id);
    subExamData.value = question;
});

const updateQuestion = async () => {
    try {
        await axios.put(`/sub-exam/${route.params.id}`, subExamData.value);
    } catch (e) {}
    router.push({ name: "admin-subExam-list" });
};
</script>

<template>
    <VRow v-if="subExamData">
        <!-- 👉 InvoiceEditable   -->
        <VCol cols="12" md="9">
            <subExamEditable :data="subExamData" />
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
