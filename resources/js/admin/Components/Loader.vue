<script setup>
import { computed } from "vue";
const props = defineProps({
    content: {
        type: String,
        default: "Please stand by",
    },
    show: {
        type: Boolean,
        default: false
    },
});
const loadng = computed(() => props.show)
</script>

<template>
    <v-dialog
        v-model="loadng"
        persistent
        width="auto"
        class="full-screen-loader"
    >
        <v-card>
            <v-card-text>
                <v-progress-circular
                    class="mb-4 circular-loader"
                    :size="70"
                    :width="4"
                    color="white"
                    indeterminate
                ></v-progress-circular>
                <p>{{ content }}</p>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
