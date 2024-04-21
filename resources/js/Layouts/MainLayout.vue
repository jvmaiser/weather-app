<script setup>
import { ref } from 'vue';
import SearchPage from '@/Components/SearchPage.vue';
import WeatherCard from '@/Components/WeatherCard.vue';

const date = new Date().toLocaleString('en-us', {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric',
});

const places = ref([]);

const addPlace = (data) => {
  places.value.push(data);
}

const deletePlace = (name) => {
  if (confirm('Are you sure')) {
    places.value = places.value.filter((place) => place.location.name !== name);
  }
}
</script>

<template>
  <main >
    <div class="text-center mb-6">
      {{ date }}
    </div>

    <SearchPage @place-data="addPlace"/>

    <template v-for="(place, id) in places" :key="id">
      <WeatherCard :place="place" @delete-place="deletePlace" />
    </template>
  </main>
</template>
