<script setup>
import AuthenticatedLayout from "@/admin/Layouts/Auth.vue";
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <AuthenticatedLayout :title="title">
        <v-container>
            <v-row>
                <v-col cols="12"><slot name="left-sidebar"></slot></v-col>
                <v-col cols="12"><slot /></v-col>
                <v-col cols="12"><slot name="right-sidebar"></slot></v-col>
            </v-row>
        </v-container>
    </AuthenticatedLayout>
</template>
