<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
const props = defineProps({
    content: {
        type: String,
        default: "",
        rewuired: false,
    },
    show: {
        type: Boolean,
        default: false,
        rewuired: false,
    },
});
const emit = defineEmits(["visible"]);
const pageData = usePage();
const visible = computed({
    get() {
        return (
            pageData.props.flash.message.success !== null ||
            pageData.props.flash.message.warning !== null ||
            pageData.props.flash.message.error !== null ||
            props.show
        );
    },
    set(newValue) {
        pageData.props.flash.message.success = null;
        pageData.props.flash.message.warning = null;
        pageData.props.flash.message.error = null;
        emit("visible", false);
    },
});
const text = computed(() => {
    if (props.content !== "") {
        return props.content;
    }
    if (pageData.props.flash.message.success !== null) {
        return pageData.props.flash.message.success;
    }
    if (pageData.props.flash.message.warning !== null) {
        return pageData.props.flash.message.warning;
    }
    if (pageData.props.flash.message.error !== null) {
        return pageData.props.flash.message.error;
    }
});
</script>
<template>
    <v-snackbar v-model="visible" multi-line color="primary" variant="tonal">
        {{ text }}
        <template v-slot:actions>
            <v-btn color="pink" variant="text" @click="visible = false">
                Close
            </v-btn>
        </template>
    </v-snackbar>
</template>
