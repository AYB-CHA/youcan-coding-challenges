<script setup lang="ts">
import type { ProductType } from '@/types/app';
import ProductItem from './ProductItem.vue';

defineProps<{
    products: ProductType[] | null,
}>();

</script>

<template>
    <table class="w-full">
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Categories</th>
        </tr>
        <ProductItem v-for="product in products" :key="product.id" :product="product" />
    </table>
</template>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #d0d0d0;
    text-align: left;
    padding: 8px;
}

tr:nth-child(odd) {
    background-color: #f2f2f2;
}
</style>