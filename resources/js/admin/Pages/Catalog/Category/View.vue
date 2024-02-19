<script setup>
import TwoColumnsLayout from "@/admin/Layouts/TwoColumns.vue";
import CategoryTree from "@/admin/Components/Catalog/Category/Tree.vue";
import CategoryForm from "@/admin/Components/Catalog/Category/Form.vue";
</script>

<template>
    <TwoColumnsLayout title="Add New Customer">
        <template v-slot:left-sidebar>
            <CategoryTree/>
        </template>
        <CategoryForm/>
    </TwoColumnsLayout>
</template>
