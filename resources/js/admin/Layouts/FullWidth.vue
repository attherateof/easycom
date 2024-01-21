<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import NavigationMenu from "@/admin/Components/Menu.vue";
import Logout from "@/admin/Components/User/Logout.vue";
import Notification from "@/admin/Components/Notification.vue";
const drawer = ref(null);
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
        <v-app-bar>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-app-bar-title>{{ title }}</v-app-bar-title>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer">
            <NavigationMenu />
            <template v-slot:append>
                <Logout />
            </template>
        </v-navigation-drawer>
        <v-main>
            <Notification/>
            <slot />
        </v-main>
        
    </v-app>
</template>
