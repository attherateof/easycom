<script setup>
import EmptyLayout from "@/admin/Layouts/Empty.vue";
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <EmptyLayout :title="title">
        <v-container class="fill-height align-center justify-center">
            <slot />
        </v-container>
    </EmptyLayout>
</template>
