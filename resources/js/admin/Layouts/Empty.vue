<script setup>
import { Head } from "@inertiajs/vue3";
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head :title="title" />
    <v-app theme="dark">
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
