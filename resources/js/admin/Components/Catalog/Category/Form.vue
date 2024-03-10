<script setup>
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import FormContainer from "@/admin/Components/Form/Container.vue";
import imageInput from "@/admin/Components/Form/Upload/Image/Single.vue";
import Loader from "@/admin/Components/Loader.vue";
import {useSlug} from "@/admin/Composable/Slug.js";
import {useImageValidation} from "@/admin/Composable/Validation/ImageValidation.js";

const {generate} = useSlug();
const {isBase64} = useImageValidation();

const props = defineProps({
    category: {
        type: Object,
        default: {},
        required: false
    },
    id: {
        type: Number,
        default: null,
        required: false
    }
});

const items = ref([
    {
        "title": "Products Only",
        "value": 0
    },
    {
        "title": "Static Content Only",
        "value": 1
    },
    {
        "title": "Both Products and Static Contents",
        "value": 2
    }
]);

const form = useForm({
    status: (props.category.hasOwnProperty('status') && props.category.status !== 0) || false,
    title: props.category.title || "",
    description: props.category.description || "",
    banner: props.category.banner || "",
    anchor: (props.category.hasOwnProperty('anchor') && props.category.anchor !== 0) || false,
    display_type: props.category.display_type || 0,
    slug: props.category.slug || "",
    meta_title: props.category.meta_title || "",
    meta_description: props.category.meta_description || "",
    meta_image: props.category.meta_image || ""
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        id: props.id,
        slug: generate(data),
        banner: isBase64(data.banner) ? data.banner : null,
        meta_image: isBase64(data.meta_image) ? data.meta_image : null,
    })).post(route("admin.catalog.category.save"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <FormContainer title="Add new Customer" @submit.prevent="submit">
        <v-switch
            v-model="form.status"
            label="Is Active?"
            color="purple-accent-4"
        ></v-switch>
        <v-text-field
            v-model="form.title"
            color="purple-accent-4"
            label="Title"
            placeholder="Category title"
            variant="outlined"
            density="comfortable"
            clearable
            required
        />
        <v-textarea
            v-model="form.description"
            color="purple-accent-4"
            label="Description"
            auto-grow
            variant="outlined"
            rows="5"
            row-height="25"
            shaped
        ></v-textarea>
        <imageInput v-model="form.banner" label="Category Banner"/>
        <v-switch
            v-model="form.anchor"
            label="Can show child category's products?"
            color="purple-accent-4"
        ></v-switch>
        <v-select
            v-model="form.display_type"
            :items="items"
            density="comfortable"
            label="Display Type"
            variant="outlined"
            color="purple-accent-4"
        ></v-select>
        <v-text-field
            v-model="form.slug"
            color="purple-accent-4"
            label="Slug"
            placeholder="Customer's first name"
            variant="outlined"
            density="comfortable"
            clearable
        />
        <v-text-field
            v-model="form.meta_title"
            color="purple-accent-4"
            label="Meta Title"
            placeholder="Customer's first name"
            variant="outlined"
            density="comfortable"
            clearable
        />
        <v-textarea
            v-model="form.meta_description"
            color="purple-accent-4"
            label="Meta Description"
            auto-grow
            variant="outlined"
            rows="3"
            row-height="25"
            shaped
        ></v-textarea>

        <imageInput v-model="form.meta_image" label="Category meta banner"/>
        <template v-slot:action>
            <v-btn color="purple-accent-4" variant="flat" type="submit">
                Submit
            </v-btn>
        </template>
    </FormContainer>
    <Loader :show="form.processing"/>
</template>
