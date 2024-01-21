<script setup>
import TwoColumnsLayout from "@/admin/Layouts/TwoColumns.vue";
import CustomerMenu from "@/admin/Components/Customer/Details/Menu.vue";
import CustomerAccountForm from "@/admin/Components/Customer/Details/Form/Account.vue";
</script>

<template>
    <TwoColumnsLayout title="Add New Customer">
        <template v-slot:left-sidebar>
            <CustomerMenu/>
        </template>
        <CustomerAccountForm/>
    </TwoColumnsLayout>
</template>
