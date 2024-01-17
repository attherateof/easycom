<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
const pageData = usePage();
const selected = ref([]);
const isDirty = ref(false);
const loading = ref(false);
const deletePopUp = ref(false);

const render = (customers) => {
    pageData.props.customers.total = customers.total;
    pageData.props.customers.data = customers.data;
};

const prepareRequest = (page, itemsPerPage) => {
    let params = {};
    if (page) {
        params.page = page;
    }

    if (itemsPerPage) {
        params.items_per_page = itemsPerPage;
    }

    return params;
};

const loadItems = async ({ page, itemsPerPage }) => {
    console.log(page);
    if (isDirty.value) {
        loading.value = true;
        let params = prepareRequest(page, itemsPerPage);
        await fetchData(params);
        updateUrl(params);
        loading.value = false;
    }
    isDirty.value = true;
};

const fetchData = async (params) => {
    await axios
        .get(route("admin.customer.list"), {
            headers: {
                "Data-Only": true,
            },
            params: params,
        })
        .then((res) => {
            render(res.data.customers);
        })
        .catch((error) => {
            console.log(error);
        });
};

const updateUrl = async (params) => {
    const url = new URL(location);
    for (const key in params) {
        if (key !== "data_only") {
            url.searchParams.set(key, params[key]);
        }
    }

    history.pushState(params, "", url);
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
                <v-btn variant="flat" color="purple-accent-4">
                    Add New Customer
                </v-btn>
            </v-toolbar>
            <v-dialog v-model="deletePopUp" max-width="500px">
                <v-card title="Attention!" subtitle="Delete customer">
                    <template v-slot:prepend>
                        <v-avatar color="red">
                            <v-icon icon="mdi-alert-circle-outline"></v-icon>
                        </v-avatar>
                    </template>
                    <v-card-text>
                        Are you sure that you want to delete this customer?
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="purple-accent-4"
                            @click="deletePopUp = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn color="red" @click="deletePopUp = false">
                            OK
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </template>

        <template v-slot:item.actions="{ item }">
            <v-icon size="small" class="me-2"> mdi-pencil </v-icon>
            <v-icon size="small" @click="deletePopUp = true">
                mdi-delete
            </v-icon>
        </template>
    </v-data-table-server>
</template>
