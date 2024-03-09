<template>
    <label>{{label}}</label>
    <div
        class="drop-container"
        @dragover.prevent="handleDragOver"
        @drop="handleDrop"
        @click="openImageInput"
    >
        <input
            type="file"
            ref="fileInput"
            style="display: none"
            @change="handleFileChange"
        />
        <img v-if="preview" :src="preview" alt="Preview" style="max-width: 100%;" />
        <p  v-else>Drag and drop or click to upload an image</p>
    </div>
</template>

<script setup>
import { ref, defineProps, getCurrentInstance } from 'vue';
import { useImage } from "@/admin/Composable/Image.js";
const { resize } = useImage();

const { modelValue, label } = defineProps(['modelValue', 'label']);
const instance = getCurrentInstance();
const emit = instance.emit;
const fileInput = ref(null);
const preview = ref(modelValue);

const openImageInput = () => {
    fileInput.value.click();
};

const handleFileChange = async () => {
    const file = fileInput.value.files[0];
    await handleFile(file);
};

const handleDragOver = (event) => {
    event.preventDefault();
};

const handleDrop = async (event) => {
    event.preventDefault();
    const file = event.dataTransfer.files[0];
    await handleFile(file);
};

const handleFile = async (file) => {
    if (file && file.type.startsWith('image/')) {
        const resizedImage = await resize(file);
        preview.value = resizedImage;
        emit('update:modelValue', resizedImage);
    }
};
</script>

<style scoped>
.drop-container {
    border: 2px dashed #2d2d2d; /* Dark gray border */
    padding: 20px;
    text-align: center;
    cursor: pointer;
    background-color: #212121; /* Dark background color */
    color: #fff; /* White text color */
    border-radius: 8px;
}

.drop-container img {
    margin-top: 10px;
    max-width: 100%;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
}

.drop-container p {
    margin: 0;
}

/* File input hidden styles */
input[type="file"] {
    display: none;
}

/* Hover effect */
.drop-container:hover {
    background-color: #2A2A2A; /* Slightly darker background on hover */
    border-color: #424242;
}

/* Active effect when dragging over */
.drop-container.drag-over {
    background-color: #3C3C3C; /* Darker background when dragging over */
}
</style>
