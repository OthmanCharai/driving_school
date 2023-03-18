<script setup>
import examEditable from "@/views/apps/exam/examEditable.vue";
import axios from "@axios";

const examData = ref({
    name: "",
    is_free: true,
    image: null,
    image_screenshot: null,
});
const router = useRouter();

const saveQuestion = async () => {
    const exam = examData.value;
    const formData = new FormData();
    formData.append("is_free", exam.is_free);
    formData.append("name", exam.name);
    formData.append("image", exam.image); // add image file to form data
    try {
        await axios.post(`/exam`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        router.push({ name: "admin-exam-list" });
    } catch (e) {
        console.log(e);
    }
};
</script>

<template>
    <VRow>
        <!-- 👉 InvoiceEditable -->
        <VCol cols="12" md="9">
            <examEditable :data="examData" />
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
