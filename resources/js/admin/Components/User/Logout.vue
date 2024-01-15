<script setup>
    import { useForm } from "@inertiajs/vue3";
    const form = useForm({});
    const submit = () => {
        form.post(route("admin.user.logout"), {});
    };
</script>

<template>
    <div class="pa-2">
        <v-form @submit.prevent="submit">
            <v-btn
                block
                type="submit"
                prepend-icon="mdi-logout"
                color="purple-accent-4"
            >
                Logout
            </v-btn>
        </v-form>
    </div>
</template>
