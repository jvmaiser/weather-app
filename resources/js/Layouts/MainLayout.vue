<script setup>
import SearchPage from '@/Components/SearchPage.vue';

const date = new Date().toLocaleString('en-us', {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric',
});
</script>

<template>
  <main >
    <div class="text-center mb-6">
      {{ date }}
    </div>

    <SearchPage/>
  </main>
</template>
