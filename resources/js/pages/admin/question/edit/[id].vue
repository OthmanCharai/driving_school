<script setup>
import InvoiceEditable from "@/views/apps/invoice/InvoiceEditable.vue";
import axios from "@axios";
import { onMounted } from "vue";

const route = useRoute();
const router = useRouter();
const questionData = ref(null);
let originalQuestion = null;

onMounted(async () => {
    let { data: question } = await axios.get(`/question/${route.params.id}`);
    originalQuestion = question;
    questionData.value = {
        ...question,
        image_screenshot: question.image,
        updatedImages: [],
        removedImages: [],
        answer_image_index:0,
    };
});

const updateQuestion = async () => {
    const question = questionData.value;
    const formData = new FormData();
    formData.append("question", question.question);
    formData.append("type", question.type);
    formData.append("sub_exam_id", question.sub_exam_id);
    formData.append("timer", question.timer);
    if (question.image !== originalQuestion.image) {
        formData.append("image", question.image); // add image file to form data
    }
    console.log(question, question.updatedImages);
    if (question.type === "images") {
        const updatedImages = question.updatedImages;
        const removedImages = question.removedImages;
        formData.append("answer_image_index", question.answer_image_index);
        removedImages.forEach((removedImage, index) => {
            formData.append(`removedImage[${index}]`, removedImage);
        });
        updatedImages.forEach((updatedImage, index) => {
            formData.append(`images[${index}]`, updatedImage.image);
        });
    } else {
        const list = question[question.type];
        list.forEach((option, index) => {
            for (const key in option) {
                formData.append(
                    `${question.type}[${index}][${key}]`,
                    option[key]
                );
            }
        });
    }
    try {
        await axios.post(`/question/${question.id}`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
            params: {
                _method: "PUT",
            },
        });
        router.push({ name: "admin-question-list" });
    } catch (e) {
        console.log(e);
    }
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
