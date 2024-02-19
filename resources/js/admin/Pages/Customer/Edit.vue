<script setup>
import TwoColumnsLayout from "@/admin/Layouts/TwoColumns.vue";
import CustomerMenu from "@/admin/Components/Customer/Details/Menu.vue";
import CustomerAccountForm from "@/admin/Components/Customer/Details/Form/Account.vue";
</script>

<template>
    <TwoColumnsLayout title="Add New Customer">
        <template v-slot:left-sidebar>
            <CustomerMenu
                full
                :account="{
                    name: 'admin.customer.edit',
                    id: $page.props.customer.id,
                }"
            />
        </template>
        <CustomerAccountForm :customer="$page.props.customer" :id="$page.props.customer.id" />
    </TwoColumnsLayout>
</template>
