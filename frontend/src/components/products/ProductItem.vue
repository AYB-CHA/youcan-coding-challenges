<script setup lang="ts">
import type { ProductType } from '@/types/app';

import { computed } from 'vue';

const { product } = defineProps<{
    product: ProductType,
}>();

const productCategories = computed(() => {
    if (!product.categories.length)
        return "N/A";
    return product.categories.map(category => category.name).join(',');
})

</script>

<template>
    <tr>
        <td>{{ product.id }}</td>
        <td>
            <img class="h-20" :src="product.image" />
        </td>
        <td>{{ product.name }}</td>
        <td>{{ product.description }}</td>
        <td>{{ product.price }}$</td>
        <td>{{ productCategories }}</td>
    </tr>
</template>