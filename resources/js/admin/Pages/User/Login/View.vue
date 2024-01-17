<script setup>
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import AuthenticationLayout from "@/admin/Layouts/Authentication.vue";
const visible = ref(false);

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("admin.user.login.authenticate"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <AuthenticationLayout title="Admin Login">
        <v-form @submit.prevent="submit">
            <v-card
                class="mx-auto pa-12 pb-8"
                elevation="8"
                max-width="448"
                rounded="lg"
            >
                <v-text-field
                    color="purple-accent-4"
                    v-model="form.email"
                    label="Account ID"
                    placeholder="Email address"
                    prepend-inner-icon="mdi-email-outline"
                    variant="outlined"
                    clearable
                    required
                    autofocus
                    autocomplete="username"
                    :error-messages="form.errors.email"
                />
                <v-text-field
                    color="purple-accent-4"
                    v-model="form.password"
                    label="Account Password"
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'"
                    placeholder="Enter your password"
                    prepend-inner-icon="mdi-lock-outline"
                    variant="outlined"
                    clearable
                    required
                    autocomplete="current-password"
                    @click:append-inner="visible = !visible"
                    :error-messages="form.errors.password"
                />

                <v-card class="mb-6" color="surface-variant" variant="tonal">
                    <v-card-text class="text-medium-emphasis text-caption">
                        Warning: After 3 consecutive failed login attempts, you
                        account will be temporarily locked for three hours. If
                        you must login now, you can also click "Forgot login
                        password?" to reset the login password.
                    </v-card-text>
                </v-card>
                <v-checkbox v-model="form.remember" label="Remember me" color="purple-accent-4"/>
                <v-btn
                    type="submit"
                    block
                    class="mb-8"
                    color="purple-accent-4"
                    size="large"
                >
                    Log In
                </v-btn>
                <div
                    v-if="canResetPassword"
                    class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between mb-1"
                >
                    <Link
                        :href="route('admin.user.password.request')"
                        class="text-caption text-decoration-none text-blue"
                        >Forgot login password?</Link
                    >
                </div>
            </v-card>
        </v-form>
    </AuthenticationLayout>
</template>
