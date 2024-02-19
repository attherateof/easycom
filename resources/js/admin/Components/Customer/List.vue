<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useApi } from "@/admin/Composable/Api.js";
import { useUrl } from "@/admin/Composable/Url.js";
import Confirmation from "@/admin/Components/Confirmation.vue";

const { fetchData, deleteData } = useApi();
const { getParams, updateUrl } = useUrl();
const pageData = usePage();
const selected = ref([]);
const loading = ref(false);
const confirmDelete = ref(false);
const item = ref(null);

const render = (customers) => {
    pageData.props.customers = customers;
};

const loadItems = async ({ page, itemsPerPage }) => {
    if (loading.value) return;
    loading.value = true;
    const params = { page, items_per_page: itemsPerPage };
    const data = await fetchData(route("admin.customer.list"), params);
    render(data.customers);
    updateUrl(params);
    loading.value = false;
};

const deleteItem = async (rowItem) => {
    item.value = rowItem;
    confirmDelete.value = true;
};

const canDelete = async (success) => {
    confirmDelete.value = false;
    if (success && item.value) {
        loading.value = true;
        const deleted = await deleteData(route("admin.customer.delete"), [item.value.id]);
        if (deleted) {
            const params = getParams();
            const data = await fetchData(route("admin.customer.list"), params);
            render(data.customers);
        }
        item.value = null;
        loading.value = false;
    }
};
</script>
<template>
    <v-data-table-server
        v-model:items-per-page="$page.props.customers.per_page"
        v-model="selected"
        :headers="$page.props.headers"
        :page="$page.props.customers.current_page"
        :items-length="$page.props.customers.total"
        :items="$page.props.customers.data"
        :loading="loading"
        show-current-page
        item-value="id"
        return-object
        fixed-header
        show-select
        height="600"
        @update:options="loadItems"
    >
        <template v-slot:top>
            <v-toolbar>
                <v-toolbar-title>Customers</v-toolbar-title>
                <v-divider inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-btn
                    variant="flat"
                    color="purple-accent-4"
                    @click="$inertia.get(route('admin.customer.add'))"
                >
                    Add New Customer
                </v-btn>
            </v-toolbar>
            <Confirmation
                message="Are you sure that you want to delete this customer?"
                title="Attention!"
                subtitle="Delete customer"
                icon="mdi-alert-circle-outline"
                :show="confirmDelete"
                @close="canDelete"
            />
        </template>

        <template v-slot:item.actions="{ item }">
            <v-icon size="small" class="me-2" @click="$inertia.get(route('admin.customer.edit', item.id))"> mdi-pencil </v-icon>
            <v-icon size="small" @click="deleteItem(item)"> mdi-delete </v-icon>
        </template>
    </v-data-table-server>
</template>