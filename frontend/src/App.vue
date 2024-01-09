<script setup lang="ts">
import NewCategory from './components/NewCategory.vue';

</script>

<template>
  <div class="h-screen grid grid-cols-6 grid-rows-2">
    <div class="row-span-2 col-span-4 p-4 border-r" />
    <div class="p-4 col-span-2 border-b" />
    <div class="p-4 col-span-2">
      <NewCategory />
    </div>
  </div>
</template>

<style scoped></style>
