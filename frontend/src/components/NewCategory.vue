<script setup lang="ts">
import type { CategoryType } from '@/types/app';

import Button from './ui/Button.vue';
import axios from '@/lib/axios';

import { AxiosError } from 'axios';
import { ref } from 'vue';


const emit = defineEmits([
    "categories-changed"
]);

defineProps<{
    categories: CategoryType[]
}>();

const categoryName = ref("");
const parentCategory = ref(-1);
const alert = ref<string | null>(null);

const createCategory = async () => {
    alert.value = "";

    try {
        await axios.post('/categories', {
            name: categoryName.value,
            parent_id: parentCategory.value !== -1 ? parentCategory.value : null,
        });
        emit("categories-changed");
    } catch (e) {
        let message = "Something went wrong.";
        if (e instanceof AxiosError)
            message = e.response?.data.message;
        alert.value = message;
    }

    parentCategory.value = -1;
    categoryName.value = "";
}


</script>

<template>
    <div>
        <h2 class="text-xl font-semibold mb-4">New Category</h2>
        <p class="mb-6 border p-4" v-if="alert">{{ alert }}</p>
        <form @submit.prevent="createCategory">
            <label class="mb-4 block">Category Name</label>
            <input v-model="categoryName" class="p-2 mb-4 border block w-full focus:outline-none" />
            <label class="mb-4 block">Parent Category</label>
            <select class="p-2 mb-6 border block w-full focus:outline-none" v-model="parentCategory">
                <option value="-1">None</option>
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