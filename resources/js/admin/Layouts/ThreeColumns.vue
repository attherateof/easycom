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
        <v-container>
            <v-row>
                <v-col xs="12" sm="12" lg="2" >
                    <slot name="left-sidebar"></slot>
                </v-col>
                <v-col lg="8" sm="12" xs="12"><slot /></v-col>
                <v-col lg="2" sm="12" xs="12">
                    <slot name="right-sidebar"></slot>
                </v-col>
            </v-row>
        </v-container>
    </FullWidthLayout>
</template>
