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
                <v-col lg="3" sm="12" xs="12">
                    <div>
                        <slot name="left-sidebar"></slot>
                    </div>
                    <div>
                        <slot name="right-sidebar"></slot>
                    </div>
                </v-col>
                <v-col lg="9" sm="12" xs="12"><slot /></v-col>
            </v-row>
        </v-container>
    </FullWidthLayout>
</template>
