<script setup>
import examEditable from "@/views/apps/exam/examEditable.vue";
import axios from "@axios";
import { onMounted } from "vue";

const route = useRoute();
const router = useRouter();
const questionData = ref(null);
let originalExam = null

onMounted(async () => {
    let { data: question } = await axios.get(`/exam/${route.params.id}`);
    originalExam = question;
    questionData.value = {
        ...question,
        image_screenshot: question.image,
    };
});

const updateQuestion = async () => {
    const question = questionData.value;
    const formData = new FormData();
    formData.append("is_free", question.is_free);
    formData.append("name", question.name);
    if (question.image !== originalExam.image ){
        formData.append("image", question.image); // add image file to form data
    }
    try {
        await axios.post(`/exam/${question.id}`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
            params: {
                _method: "PUT",
            },
        });
        router.push({ name: "admin-exam-list" });
    } catch (e) {
        console.log(e);
    }
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
