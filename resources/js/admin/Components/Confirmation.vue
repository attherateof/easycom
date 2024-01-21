<script setup>
import { computed } from "vue";
const props = defineProps({
    message: {
        type: String,
        default: "",
    },
    title: {
        type: String,
        default: "",
    },
    subtitle: {
        type: String,
        default: "",
    },
    icon: {
        type: String,
        default: "mdi-alert-circle-outline",
    },
    show: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(["close"]);
const load = computed(() => props.show);

const action = (success) => {
    emit("close", success);
};
</script>

<template>
    <v-dialog v-model="load" max-width="500px">
        <v-card :title="title" :subtitle="subtitle">
            <template v-slot:prepend>
                <v-avatar color="red">
                    <v-icon :icon="icon"></v-icon>
                </v-avatar>
            </template>
            <v-card-text>
                {{ message }}
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="purple-accent-4" @click="action(false)">
                    Cancel
                </v-btn>
                <v-btn color="red" @click="action(true)"> OK </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
