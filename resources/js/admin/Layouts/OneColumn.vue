<script setup>
import FullWidthLayout from "@/admin/Layouts/FullWidth.vue";
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <FullWidthLayout :title="title">
        <v-container fluid>
            <v-row>
                <v-col cols="12"><slot /></v-col>
                <v-col cols="12"><slot name="left-sidebar"></slot></v-col>
                <v-col cols="12"><slot name="right-sidebar"></slot></v-col>
            </v-row>
        </v-container>
    </FullWidthLayout>
</template>
