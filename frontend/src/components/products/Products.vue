<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import type { CategoryType, ProductType } from '@/types/app';

import { useFetch } from '@/composables/useFetch';
import { ref, watch } from 'vue';

import ProductsTable from './ProductsTable.vue'
import NewProduct from './NewProduct.vue'

defineProps<{
    categories: CategoryType[]
}>();

const priceSorting = ref(false);
const selectedCategoryId = ref<number | undefined>(undefined);

const { data: products, error, mutate } = useFetch<ProductType[]>('/products');

const filterProducts = () => {
    mutate({
        category_id: selectedCategoryId.value?.toString(),
        sort: priceSorting.value ? "true" : undefined,
    });
}

watch([priceSorting, selectedCategoryId], filterProducts);

</script>

<template>
    <div class="row-span-2 col-span-4 p-4 border-r">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold">Products</h2>
            <div>
                <div class="flex gap-2">
                    <label for="sortByPrice">Price Asc/Desc</label>
                    <input type="checkbox" id="sortByPrice" v-model="priceSorting" />
                </div>
                <div class="flex gap-2">
                    <label for="categorySelector">Category</label>
                    <select id="categorySelector" v-model="selectedCategoryId">
                        <option :value="undefined">all</option>
                        <template v-for="category in categories" :key="category.id">
                            <option :value="category.id">{{ category.name }}</option>
                        </template>
                    </select>
                </div>
            </div>
        </div>
        <ProductsTable :products="products" />
        <div>
            <div class="text-center py-4">
                <span v-if="error">An error happened while loading products</span>
                <span v-else-if="!products?.length">No Products Found</span>
            </div>
        </div>
    </div>
    <div class="p-4 col-span-2 border-b">
        <NewProduct @products-updated="filterProducts" :categories="categories" />
    </div>
</template>