<script setup>
import InvoiceEditable from "@/views/apps/invoice/InvoiceEditable.vue";
import axios from "@axios";

const router = useRouter();
const questionData = ref({
    type: "options",
    question: "",
    sub_exam_id: 1,
    options: [
        {
            status: false,
            answer: "",
        },
    ],
    image: null,
    image_screenshot: null,
});
const saveQuestion = async () => {
    // router.push({ name: "admin-question-list" }); // TODO
    const question = questionData.value;
    const formData = new FormData();
    formData.append("question", question.question);
    formData.append("type", question.type);
    formData.append("sub_exam_id", question.sub_exam_id);
    formData.append("image", question.image); // add image file to form data
    const list = question[question.type];
    console.log(question, list);
    list.forEach((option, index) => {
        for (const key in option) {
            formData.append(`${question.type}[${index}][${key}]`, option[key]);
        }
    });
    try {
        await axios.post(`/question`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    } catch (e) {
        console.log(e);
    }
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
