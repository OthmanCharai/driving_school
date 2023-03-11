<script setup>
import subExamEditable from "@/views/apps/subExam/subExamEditable.vue";
import axios from "@axios";

const subExamData = ref({
    name: "",
    note: 0,
    exam_id: null,
});
const router = useRouter();

const saveQuestion = async () => {
    router.push({ name: "admin-subExam-list" });
    const subExam = subExamData.value;
    try {
        await axios.post(`/sub-exam`, { ...subExam });
    } catch (e) {
        console.log(e);
    }
};
</script>

<template>
    <VRow>
        <!-- 👉 InvoiceEditable -->
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
                        color="default"
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
                    <VBtn block @click="saveQuestion"> Save </VBtn>
                </VCardText>
            </VCard>
        </VCol>
    </VRow>
</template>
