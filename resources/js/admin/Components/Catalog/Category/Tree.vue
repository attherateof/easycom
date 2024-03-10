<template>
    <v-card
        title="Categories"
        class="tree-container"
    >
        <v-card-text class="scrollable">
            <template v-if="tree.length">
                <NestedDraggable :children="tree" :depth="0" pageRoute="admin.catalog.category.edit"/>
            </template>
        </v-card-text>
    </v-card>

</template>

<script setup>
import {ref, onMounted } from "vue";
import NestedDraggable from "@/admin/Components/NestedTree.vue";
import {useTree} from "@/admin/Composable/Tree.js";

const props = defineProps({
    categories: {
        type: Object,
        default: [],
        required: false
    }
});
const {generateTree} = useTree();
const tree = ref([]);

onMounted(() => {
    tree.value = generateTree(props.categories)
})
</script>
