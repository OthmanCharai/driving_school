<script setup>
import { useInvoiceStore } from "@/views/apps/invoice/useInvoiceStore";
import { avatarText } from "@core/utils/formatters";
import axios from "@axios";

const searchQuery = ref("");
const selectedStatus = ref();
const rowPerPage = ref(10);
const currentPage = ref(1);
const totalPage = ref(1);
const totalInvoices = ref(0);
const invoices = ref([]);
const selectedRows = ref([]);

// 👉 Fetch Invoices
watchEffect(async () => {
    let { data } = await axios.get("/question", { params: {} });
    invoices.value = data;
    totalPage.value = 10;
    totalInvoices.value = 10;
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

// 👉 Invoice balance variant resolver
const resolveInvoiceBalanceVariant = (balance, total) => {
    if (balance === total)
        return {
            status: "Unpaid",
            chip: { color: "error" },
        };
    if (balance === 0)
        return {
            status: "Paid",
            chip: { color: "success" },
        };

    return {
        status: balance,
        chip: { variant: "text" },
    };
};

const resolveInvoiceStatusVariantAndIcon = (status) => {
    if (status === "Partial Payment")
        return {
            variant: "success",
            icon: "tabler-circle-half-2",
        };
    if (status === "Paid")
        return {
            variant: "warning",
            icon: "tabler-chart-pie",
        };
    if (status === "Downloaded")
        return {
            variant: "info",
            icon: "tabler-arrow-down-circle",
        };
    if (status === "Draft")
        return {
            variant: "primary",
            icon: "tabler-device-floppy",
        };
    if (status === "Sent")
        return {
            variant: "secondary",
            icon: "tabler-circle-check",
        };
    if (status === "Past Due")
        return {
            variant: "error",
            icon: "tabler-alert-circle",
        };

    return {
        variant: "secondary",
        icon: "tabler-x",
    };
};

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
                    :to="{ name: 'admin-invoice-add' }"
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
                <div class="invoice-list-filter">
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
                </div>
            </div>
        </VCardText>

        <VDivider />

        <!-- SECTION Table -->
        <VTable class="text-no-wrap invoice-list-table">
            <!-- 👉 Table head -->
            <thead class="text-uppercase">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col" class="text-center">
                        <VIcon icon="tabler-trending-up" />
                    </th>

                    <th scope="col">Title</th>

                    <th scope="col" class="text-center">Score</th>

                    <th scope="col">Creation Date</th>

                    <th scope="col" class="text-center">Update Date</th>

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
                                name: 'admin-invoice-preview-id',
                                params: { id: invoice.id },
                            }"
                        >
                            #{{ invoice.id }}
                        </RouterLink>
                    </td>

                    <!-- 👉 Trending -->
                    <td class="text-center">
                        <VTooltip>
                            <template #activator="{ props }">
                                <VAvatar
                                    :size="30"
                                    v-bind="props"
                                    :color="
                                        resolveInvoiceStatusVariantAndIcon(
                                            invoice.invoiceStatus
                                        ).variant
                                    "
                                    variant="tonal"
                                >
                                    <VIcon
                                        :size="20"
                                        :icon="
                                            resolveInvoiceStatusVariantAndIcon(
                                                invoice.invoiceStatus
                                            ).icon
                                        "
                                    />
                                </VAvatar>
                            </template>

                            <p class="mb-0">
                                {{ invoice.invoiceStatus }}
                            </p>
                            <p class="mb-0">Balance: {{ invoice.balance }}</p>
                            <p class="mb-0">Due date: {{ invoice.dueDate }}</p>
                        </VTooltip>
                    </td>

                    <!-- 👉 Client Avatar and Email -->
                    <td>
                        <div class="d-flex align-center">
                            <VAvatar size="34" variant="tonal" class="me-3">
                                <VImg :src="invoice.avatar" />
                                <!-- v-if="invoice.avatar.length" -->
                                <!-- <span v-else>{{
                                    avatarText(invoice.client.name)
                                }}</span> -->
                            </VAvatar>

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

                    <!-- 👉 Date -->
                    <td>{{ invoice.issuedDate }}</td>

                    <!-- 👉 Balance -->
                    <td class="text-center">
                        <VChip
                            label
                            v-bind="
                                resolveInvoiceBalanceVariant(
                                    invoice.balance,
                                    invoice.total
                                ).chip
                            "
                            size="small"
                        >
                            {{
                                resolveInvoiceBalanceVariant(
                                    invoice.balance,
                                    invoice.total
                                ).status
                            }}
                        </VChip>
                    </td>

                    <!-- 👉 Actions -->
                    <td style="width: 8rem">
                        <VBtn
                            icon
                            variant="text"
                            color="default"
                            size="x-small"
                            @click="deleteQuestion(invoice.id, index)"
                        >
                            <VIcon icon="tabler-mail" :size="22" />D
                        </VBtn>

                        <VBtn
                            icon
                            variant="text"
                            color="default"
                            size="x-small"
                            :to="{
                                name: 'admin-invoice-preview-id',
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
                        >
                            <VIcon :size="22" icon="tabler-dots-vertical" />

                            <VMenu activator="parent">
                                <VList>
                                    <VListItem value="download">
                                        <template #prepend>
                                            <VIcon
                                                size="24"
                                                class="me-3"
                                                icon="tabler-download"
                                            />
                                        </template>

                                        <VListItemTitle
                                            >Download</VListItemTitle
                                        >
                                    </VListItem>

                                    <VListItem
                                        :to="{
                                            name: 'admin-invoice-edit-id',
                                            params: { id: invoice.id },
                                        }"
                                    >
                                        <template #prepend>
                                            <VIcon
                                                size="24"
                                                class="me-3"
                                                icon="tabler-pencil"
                                            />
                                        </template>

                                        <VListItemTitle>Edit</VListItemTitle>
                                    </VListItem>
                                    <VListItem value="duplicate">
                                        <template #prepend>
                                            <VIcon
                                                size="24"
                                                class="me-3"
                                                icon="tabler-stack"
                                            />
                                        </template>

                                        <VListItemTitle
                                            >Duplicate</VListItemTitle
                                        >
                                    </VListItem>
                                </VList>
                            </VMenu>
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
