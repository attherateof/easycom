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
        <v-card-actions class="py-4">
            <v-btn color="purple-accent-4 mt-1" block variant="text" type="button" @click="reorder()">
                Save order
            </v-btn>
        </v-card-actions>
    </v-card>

</template>

<script setup>
import {ref, onMounted } from "vue";
import NestedDraggable from "@/admin/Components/NestedTree.vue";
import {useTree} from "@/admin/Composable/Tree.js";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Object,
        default: [],
        required: false
    }
});
const {generateTree, makeFlat} = useTree();
const tree = ref([]);

onMounted(() => {
    tree.value = generateTree(props.categories)
})

const reorder =  () => {
   let flatTree =  makeFlat(tree.value)
    let path = route('admin.catalog.category.reorder')
    router.post(path,{
        list : flatTree
    })
};

</script>
