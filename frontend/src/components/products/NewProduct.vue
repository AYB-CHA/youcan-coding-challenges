<script setup lang="ts">
import type { CategoryType } from '@/types/app';

import Button from '../ui/Button.vue';
import axios from '@/lib/axios';

import { AxiosError } from 'axios';
import { ref } from 'vue';
import ImageUploadInput from './ImageUploadInput.vue';

defineProps<{
    categories: CategoryType[],
}>();

const emit = defineEmits(['products-updated']);

const alert = ref<string | null>(null);

const name = ref("");
const description = ref("");
const image = ref("");
const price = ref(0);
const selectedCategories = ref<number[]>([]);

const createProduct = async () => {
    const data = {
        name: name.value,
        description: description.value,
        price: price.value,
        image: image.value,
        categories: selectedCategories.value.length ? selectedCategories.value : null,
    }
    try {
        await axios.post('/products', data);
        emit('products-updated');

        name.value = '';
        description.value = '';
        price.value = 0;
        image.value = '';
        selectedCategories.value = [];
    } catch (e) {
        let message = "Something went wrong.";
        if (e instanceof AxiosError)
            message = e.response?.data.message;
        alert.value = message;
    }
}

const changeImage = (url: string) => {
    image.value = url;
}

const setError = (url: string) => {
    alert.value = url;
}

</script>

<template>
    <div class="h-full overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4">New Product</h2>
        <p class="mb-6 border p-4" v-if="alert">{{ alert }}</p>
        <form @submit.prevent="createProduct">
            <label class="mb-4 block">Product Name</label>
            <input v-model="name" class="p-2 mb-4 border block w-full focus:outline-none" />
            <label class="mb-4 block">Description</label>
            <input v-model="description" class="p-2 mb-4 border block w-full focus:outline-none" />
            <label class="mb-4 block">Price</label>
            <input v-model="price" class="p-2 mb-4 border block w-full focus:outline-none" type="number" />
            <ImageUploadInput :change-image="changeImage" :error="setError" :currentImage="image" />
            <label lass="mb-4 block">Categories</label>
            <select class="my-4 block w-full border p-4" multiple v-model="selectedCategories">
                <template v-for="category in categories" :key="category.id">
                    <option :value="category.id">{{ category.name }}</option>
                </template>
            </select>
            <Button>
                Submit
            </Button>
        </form>
    </div>
</template>