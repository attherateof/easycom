<script setup>
defineProps({
    backRoute: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <form>
        <v-card class="mb-4">
            <template v-slot:title> {{ title }} </template>
            <template v-slot:append>
                <v-btn
                    color="purple-accent-4"
                    variant="text"
                    prepend-icon="mdi-keyboard-backspace"
                    @click="$inertia.get(route(backRoute))"
                >
                    Back
                </v-btn>
            </template>
            <v-card-text class="scrollable">
                <slot />
            </v-card-text>
            <v-card-actions class="py-4">
                <v-spacer></v-spacer>
                <slot name="action"></slot>
            </v-card-actions>
        </v-card>
    </form>
</template>
