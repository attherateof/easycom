<template>
    <draggable
        class="tree"
        tag="ul"
        :list="props.children"
        :group="{ name: 'g1' }"
        item-key="name"
    >
        <template #item="{ element }">
            <li @click="$inertia.get(route('admin.catalog.category.edit', element.id))">
                <span v-ripple>
                    {{ element.title }}
                </span>
                <NestedTree :children="element.children"/>
            </li>
        </template>
    </draggable>
</template>

<script setup>
import draggable from "vuedraggable";
const props = defineProps({
    children: {
        type: Array,
        default: [],
        required: false
    },

});
</script>

<style scoped>
ul {
    margin-left: 20px;
    min-height: 20px;
}
ul li {
    list-style-type: none;
    margin: 10px 0 10px 10px;
    position: relative;
}
ul li:before {
    content: "";
    position: absolute;
    top: -10px;
    left: -20px;
    border-left: 1px solid #3C3C3C;
    border-bottom: 1px solid #3C3C3C;
    width: 20px;
    height: 11px;
}
ul li:after {
    position: absolute;
    content: "";
    top: 0px;
    left: -20px;
    border-left: 1px solid #3C3C3C;
    border-top: 1px solid #3C3C3C;
    width: 20px;
    height: 100%;
}
ul li:last-child:after {
    display: none;
}
ul li span {
    display: block;
    border: 1px solid #3C3C3C;
    padding: 10px;
    color: #e7e7e7;
    text-decoration: none;
    transition-duration: ease 0.7s;
    cursor: pointer;
    border-radius: 0px 4px 4px 4px;
    transition: background-color 0.3s ease;
}
ul li span:hover,
ul li span:focus {
    background-color: #2A2A2A;
}
</style>
