<script setup lang="ts">

import { AxiosError } from 'axios';
import { ref } from 'vue';

import axios from '@/lib/axios';

type ImageUploadResponse = {
    url: string
}

const { changeImage, error } = defineProps<{
    changeImage: (url: string) => void;
    error: (url: string) => void;
    currentImage: string,
}>();

const imageInput = ref<HTMLInputElement>();

const change = async () => {
    if (!imageInput.value?.files)
        return;

    const form = new FormData();
    form.append('image', imageInput.value?.files[0]);

    try {
        const { data } = await axios.post<ImageUploadResponse>('/upload/image', form);
        changeImage(data.url);
        imageInput.value.value = '';
    } catch (e) {
        error("Something went wrong.");
        if (e instanceof AxiosError && e.response?.data.message)
            error(e.response?.data.message);
    }
}

</script>
<template>
    <label class="mb-4 block">Image</label>
    <input @change="change" ref="imageInput" class="p-2 mb-4 border block w-full focus:outline-none" type="file"
        accept="image/png, image/jpeg, image/jpg" />
    <div v-if="currentImage.length" class="mb-4">
        <img class="h-40" :src="currentImage" alt="upload image preview" />
    </div>
</template>