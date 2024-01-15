<script setup>
import { ref } from "vue";
import OneColumnLayout from "@/admin/Layouts/OneColumn.vue";
// import TwoColumnsLayout from "@/admin/Layouts/TwoColumns.vue";
// import ThreeColumnsLayout from "@/admin/Layouts/ThreeColumns.vue";
const drawer = ref(null);
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <OneColumnLayout title="Home">
        <template #left-sidebar> Left Side Bar </template>
        <template #right-sidebar> Right Side Bar </template>
        Main Content
    </OneColumnLayout>
</template>
