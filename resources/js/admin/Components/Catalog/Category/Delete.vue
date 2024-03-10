<script setup>
import { ref } from "vue";
import { router } from '@inertiajs/vue3'
import Confirmation from "@/admin/Components/Confirmation.vue";
const confirmDelete = ref(false);
const props = defineProps({
    id: {
        type: Number,
        required: true
    }
});
const deleteItem = async () => {
    confirmDelete.value = true;
};

const canDelete = async (success) => {
    confirmDelete.value = false;
    if (success) {
        let path = route('admin.catalog.category.delete', props.id)
        router.delete(path)
    }
};
</script>

<template>
    <v-btn color="purple-accent-4" variant="text" type="button" prepend-icon="mdi-delete-empty-outline" @click="deleteItem()">
        Delete
    </v-btn>

    <Confirmation
        message="Are you sure that you want to delete this Category?"
        title="Attention!"
        subtitle="Delete Category"
        icon="mdi-alert-circle-outline"
        :show="confirmDelete"
        @close="canDelete"
    />
</template>
