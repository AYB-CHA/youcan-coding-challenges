<script setup lang="ts">
import type { CategoryType } from './types/app';

import { useFetch } from './composables/useFetch';

import NewCategory from './components/NewCategory.vue';

const { data: categories, mutate } = useFetch<CategoryType[]>("/categories");

</script>

<template>
  <div class="h-screen grid grid-cols-6 grid-rows-2">
    <div class="row-span-2 col-span-4 p-4 border-r" />
    <div class="p-4 col-span-2 border-b" />
    <div class="p-4 col-span-2">
      <NewCategory v-if="categories" :categories="categories" @categories-changed="mutate" />
    </div>
  </div>
</template>

<style scoped></style>
