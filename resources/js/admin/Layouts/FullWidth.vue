<script setup>
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
const drawer = ref(null);
defineProps({
    title: {
        type: String,
        required: true,
    },
});

const form = useForm({});
const submit = () => {
    form.post(route("admin.user.logout"), {});
};
</script>

<template>
    <Head :title="title" />
    <v-app theme="dark">
        <v-app-bar>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-app-bar-title>{{ title }}</v-app-bar-title>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer">
            <v-list>
                <v-list-item
                    prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                    :title="$page.props.auth.user.name"
                    :subtitle="$page.props.auth.user.email"
                />
            </v-list>

            <v-divider />

            <v-list density="compact" nav>
                <v-list-item
                    prepend-icon="mdi-home"
                    title="Home"
                    value="home"
                ></v-list-item>

                <v-list-group value="Sales">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi-currency-inr"
                            title="Sales"
                        ></v-list-item>
                    </template>

                    <v-list-item title="Order" value="order" />
                    <v-list-item title="Invoice" value="invoice" />
                    <v-list-item title="Shipment" value="shipment" />
                    <v-list-item title="Refund" value="Refund" />
                </v-list-group>
                <v-list-group value="Catalog">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi-package-variant-closed"
                            title="Catalog"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        title="Categories"
                        value="categories"
                    ></v-list-item>
                    <v-list-item
                        title="Products"
                        value="products"
                    ></v-list-item>
                </v-list-group>
                <v-list-item
                    prepend-icon="mdi-account-multiple"
                    title="Customers"
                    value="customers"
                ></v-list-item>
                <v-list-item
                    prepend-icon="mdi-arrow-u-down-left"
                    title="Return Management"
                    value="return"
                />
                <v-list-group value="Blog">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi-post-lamp"
                            title="Blog"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        title="Categories"
                        value="categories"
                    ></v-list-item>
                    <v-list-item title="Posts" value="posts"></v-list-item>
                    <v-list-item
                        title="Comments"
                        value="comments"
                    ></v-list-item>
                </v-list-group>
                <v-list-item
                    prepend-icon="mdi-cogs"
                    title="Settings"
                    value="settings"
                />
                <v-list-group value="System">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi-store-cog"
                            title="System"
                        ></v-list-item>
                    </template>

                    <v-list-item title="Admins" value="admins"></v-list-item>
                    <v-list-item
                        title="Permissions"
                        value="permissions"
                    ></v-list-item>
                    <v-list-item
                        title="Activity"
                        value="activity"
                    ></v-list-item>
                </v-list-group>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <v-form @submit.prevent="submit">
                        <v-btn block type="submit" prepend-icon="mdi-logout" color="purple-accent-4"> Logout </v-btn>
                    </v-form>                    
                </div>
            </template>
        </v-navigation-drawer>
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
