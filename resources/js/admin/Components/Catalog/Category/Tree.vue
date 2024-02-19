<template>
    <v-card
        title="Categories"
        subtitle="List of all categories"
        class="tree-container"
    >
        <div style="padding: 10px;">
            <NestedDraggable :children="list" :depth="0"/>
        </div>
    </v-card>
</template>

<script setup>
import { ref } from "vue";
import NestedDraggable from "@/admin/Components/NestedTree.vue";

const list = ref([
    {
        name: "task 1",
        children: [
            {
                name: "task 2",
                children: [],
            },
        ],
    },
    {
        name: "task 3",
        children: [
            {
                name: "task 4",
                children: [],
            },
        ],
    },
    {
        name: "task 5",
        children: [],
    },
]);
</script>
