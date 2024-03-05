<script setup>
import OneColumnLayout from "@/admin/Layouts/OneColumn.vue";
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
    </OneColumnLayout>
</template>
