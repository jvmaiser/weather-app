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

const addPlace = (placeWeather) => {
  places.value.unshift(placeWeather);
}

const deletePlace = (name) => {
  if (confirm('Are you sure you want to delete?')) {
    places.value = places.value.filter((place) => place.city !== name);
  }
}
</script>

<template>
  <main >
    <div class="text-center mb-6 text-2xl">
      {{ date }}
    </div>

    <SearchPage @place-data="addPlace" />

    <div class="grid grid-cols-2 gap-4">
      <div v-for="(place, id) in places" :key="id">
        <WeatherCard :place="place.weather" :city="place.city" @delete-place="deletePlace" />
      </div>
    </div>
  </main>
</template>
