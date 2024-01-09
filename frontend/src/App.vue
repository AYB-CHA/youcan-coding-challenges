<script setup lang="ts">
import type { CategoryType } from './types/app';

import { useFetch } from './composables/useFetch';

import Products from './components/products/Products.vue';
import NewCategory from './components/NewCategory.vue';

const { data: categories, mutate } = useFetch<CategoryType[]>("/categories");

</script>

<template>
  <div class="h-screen grid grid-cols-6 grid-rows-2">
    <Products v-if="categories" :categories="categories" />
    <div class="p-4 col-span-2">
      <NewCategory v-if="categories" :categories="categories" @categories-changed="mutate" />
    </div>
  </div>
</template>

<style scoped></style>
