<script setup>
import { useInvoiceStore } from "@/views/apps/invoice/useInvoiceStore";
import { avatarText } from "@core/utils/formatters";
import axios from "@axios";

const searchQuery = ref("");
const rowPerPage = ref(10);
const currentPage = ref(1);
const totalPage = ref(1);
const totalInvoices = ref(0);
const invoices = ref([]);
const selectedRows = ref([]);

// 👉 Fetch Invoices
watchEffect(async () => {
    let { data } = await axios.get("/exam", {
        params: {
            page: currentPage.value,
            perPage: rowPerPage.value,
            q: searchQuery.value,
        },
    });
    console.log(data);
    const { data: exams, meta } = data;
    invoices.value = exams;
    console.log(meta);
    totalPage.value = meta.last_page;
    totalInvoices.value = meta.total;
});

// 👉 Fetch Invoices
watchEffect(() => {
    if (currentPage.value > totalPage.value)
        currentPage.value = totalPage.value;
});

// 👉 Computing pagination data
const paginationData = computed(() => {
    const firstIndex = invoices.value.length
        ? (currentPage.value - 1) * rowPerPage.value + 1
        : 0;
    const lastIndex =
        invoices.value.length + (currentPage.value - 1) * rowPerPage.value;

    return `Showing ${firstIndex} to ${lastIndex} of ${totalInvoices.value} entries`;
});

const deleteQuestion = (id, index) => {
    invoices.value.splice(index, 1);
    axios.delete(`/question/${id}`);
};
</script>

<template>
    <VCard v-if="invoices" id="invoice-list">
        <VCardText class="d-flex align-center flex-wrap gap-4">
            <!-- 👉 Rows per page -->
            <div class="d-flex align-center" style="width: 135px">
                <span class="text-no-wrap me-3">Show:</span>
                <VSelect
                    v-model="rowPerPage"
                    density="compact"
                    :items="[10, 20, 30, 50]"
                />
            </div>

            <div class="me-3">
                <!-- 👉 Create Question -->
                <VBtn
                    prepend-icon="tabler-plus"
                    :to="{ name: 'admin-exam-add' }"
                >
                    Create Question
                </VBtn>
            </div>

            <VSpacer />

            <div class="d-flex align-center flex-wrap gap-4">
                <!-- 👉 Search  -->
                <div class="invoice-list-filter">
                    <VTextField
                        v-model="searchQuery"
                        placeholder="Search Invoice"
                        density="compact"
                    />
                </div>

                <!-- 👉 Select status -->
                <!-- <div class="invoice-list-filter">
                    <VSelect
                        v-model="selectedStatus"
                        label="Select Status"
                        clearable
                        clear-icon="tabler-x"
                        single-line
                        :items="[
                            'Downloaded',
                            'Draft',
                            'Sent',
                            'Paid',
                            'Partial Payment',
                            'Past Due',
                        ]"
                    />
                </div> -->
            </div>
        </VCardText>

        <VDivider />

        <!-- SECTION Table -->
        <VTable class="text-no-wrap invoice-list-table">
            <!-- 👉 Table head -->
            <thead class="text-uppercase">
                <tr>
                    <th scope="col">#ID</th>

                    <th scope="col">Image</th>

                    <th scope="col">Name</th>

                    <th scope="col" class="text-center">Users</th>

                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>

            <!-- 👉 Table Body -->
            <tbody>
              
                <tr
                    v-for="(invoice, index) of invoices"
                    :key="invoice.id"
                    style="height: 3.75rem"
                >
                    <!-- 👉 Id -->
                    <td>
                        <RouterLink
                            :to="{
                                name: 'admin-exam-preview-id',
                                params: { id: invoice.id },
                            }"
                        >
                            #{{ invoice.id }}
                        </RouterLink> 
                    </td>

                    <!-- 👉 Client Avatar and Email -->
                    <td>
                        <div class="d-flex align-center">
                            <!-- <VAvatar size="34" variant="tonal" class="me-3"> -->
                            <!-- <VImg :src="invoice.avatar" /> -->
                            <!-- v-if="invoice.avatar.length" -->
                            <!-- <span v-else>{{
                                    avatarText(invoice.client.name)
                                }}</span> -->
                            <!-- </VAvatar> -->

                            <div class="d-flex flex-column">
                                <!-- <h6 class="text-base font-weight-medium mb-0">
                                    {{ invoice.client.name }}
                                </h6> -->
                                <span class="text-disabled text-sm">{{
                                    invoice.question
                                }}</span>
                            </div>
                        </div>
                    </td>

                    <!-- 👉 total -->
                    <td class="text-center">{{ invoice.score || 10 }}</td>
                    <!-- TODO REMOVE -->

                    <!-- 👉 Actions -->
                    <td style="width: 8rem">
                        <VBtn
                            icon
                            variant="text"
                            color="default"
                            size="x-small"
                            :to="{
                                name: 'admin-invoice-edit-id',
                                params: { id: invoice.id },
                            }"
                        >
                            <VIcon :size="22" icon="tabler-eye" />
                        </VBtn>
                        <VBtn
                            icon
                            variant="text"
                            color="default"
                            size="x-small"
                            :to="{
                                name: 'admin-invoice-edit-id',
                                params: { id: invoice.id },
                            }"
                        >
                            <VIcon :size="22" icon="tabler-pencil" />
                        </VBtn>

                        <VBtn
                            icon
                            variant="text"
                            color="default"
                            size="x-small"
                            @click="deleteQuestion(invoice.id, index)"
                        >
                            <VIcon icon="mdi-delete" :size="22" />
                        </VBtn>
                    </td>
                </tr>
            </tbody>
            <!-- 👉 table footer  -->
            <tfoot v-show="!invoices.length">
                <tr>
                    <td colspan="8" class="text-center text-body-1">
                        {{ invoices.length }}
                        No data available
                    </td>
                </tr>
            </tfoot>
        </VTable>
        <!-- !SECTION -->

        <VDivider />

        <!-- SECTION Pagination -->
        <VCardText class="d-flex align-center flex-wrap gap-4 py-3">
            <!-- 👉 Pagination meta -->
            <span class="text-sm text-disabled">
                {{ paginationData }}
            </span>

            <VSpacer />

            <!-- 👉 Pagination -->
            <VPagination
                v-model="currentPage"
                size="small"
                :total-visible="5"
                :length="totalPage"
                @next="selectedRows = []"
                @prev="selectedRows = []"
            />
        </VCardText>
        <!-- !SECTION -->
    </VCard>
</template>

<style lang="scss">
#invoice-list {
    .invoice-list-actions {
        inline-size: 8rem;
    }

    .invoice-list-filter {
        inline-size: 12rem;
    }
}
</style>
