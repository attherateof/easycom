<script setup>
import FormContainer from "@/admin/Components/Form/Container.vue";
</script>
<template>
    <FormContainer title="Add new Customer">
        <p>General</p>
        <v-divider class="mt-2"></v-divider>
        <v-switch label="Is Active?" color="purple-accent-4"></v-switch>
        <v-text-field
            color="purple-accent-4"
            label="Title"
            placeholder="Customer's first name"
            variant="outlined"
            density="comfortable"
            clearable
            required
        />
        <v-textarea
            color="purple-accent-4"
            label="Description"
            auto-grow
            variant="outlined"
            rows="5"
            row-height="25"
            shaped
        ></v-textarea>

        <v-file-input
            color="deep-purple-accent-4"
            density="comfortable"
            counter
            label="File input"
            multiple
            placeholder="Select your files"
            prepend-icon="mdi-paperclip"
            variant="outlined"
            :show-size="1000"
        >
            <template v-slot:selection="{ fileNames }">
                <template
                    v-for="(fileName, index) in fileNames"
                    :key="fileName"
                >
                    <v-chip
                        v-if="index < 2"
                        color="deep-purple-accent-4"
                        label
                        size="small"
                        class="me-2"
                    >
                        {{ fileName }}
                    </v-chip>
                </template>
            </template>
        </v-file-input>

        <p class="mt-8">Display Settings</p>
        <v-divider class="mt-2"></v-divider>
        <v-switch
            label="Can show child category's products?"
            color="purple-accent-4"
        ></v-switch>
        <v-select
            :items="items"
            density="comfortable"
            label="Display Type"
            variant="outlined"
        ></v-select>
        
        <p class="mt-8">SEO</p>
        <v-divider class="mt-2"></v-divider>
        <v-text-field
            color="purple-accent-4"
            label="Slug"
            placeholder="Customer's first name"
            variant="outlined"
            density="comfortable"
            clearable
            required
        />
        <v-text-field
            color="purple-accent-4"
            label="Meta Title"
            placeholder="Customer's first name"
            variant="outlined"
            density="comfortable"
            clearable
            required
        />
        <v-textarea
            color="purple-accent-4"
            label="Meta Description"
            auto-grow
            variant="outlined"
            rows="3"
            row-height="25"
            shaped
        ></v-textarea>

        <v-file-input
            color="deep-purple-accent-4"
            density="comfortable"
            counter
            label="File input"
            multiple
            placeholder="Select your files"
            prepend-icon="mdi-paperclip"
            variant="outlined"
            :show-size="1000"
        >
            <template v-slot:selection="{ fileNames }">
                <template
                    v-for="(fileName, index) in fileNames"
                    :key="fileName"
                >
                    <v-chip
                        v-if="index < 2"
                        color="deep-purple-accent-4"
                        label
                        size="small"
                        class="me-2"
                    >
                        {{ fileName }}
                    </v-chip>
                </template>
            </template>
        </v-file-input>

        <template v-slot:action>
            <v-btn color="purple-accent-4" variant="flat" type="submit">
                Submit
            </v-btn>
        </template>
    </FormContainer>
</template>

<script>
export default {
    data: () => ({
        items: [
            "Products Only",
            "Sattic Content Only",
            "Both Products and Static Contents",
        ],
    }),
};
</script>
