<script setup>
import { ref } from 'vue';
import axios from 'axios';

const emit = defineEmits(['place-data']);

const searchTerm = ref({
  query: '',
  timeout: null,
  results: null,
});

const handleSearch = () => {
  try {
    clearTimeout(searchTerm.value.timeout);

    searchTerm.value.timeout = setTimeout(async () => {
      if (searchTerm.value.query !== '') {
        const cities = await axios.get('/api/cities', { params: { query: searchTerm.value.query } });
        searchTerm.value.results = await cities.data;
      } else {
        searchTerm.value.results = null;
      }
    }, 500);
  } catch (error) {
    alert('Error fetching cities:', error.message);
  }
}

const getWeather = async (place) => {
  let param = {
    lat: place.latitude,
    lon: place.longitude,
    cnt: 8,
  };

  const result = await axios.get('/api/weather', { params: param });
  const weather = await result.data;

  let emitParam = {
    weather: weather,
    city: place.city,
  }

  emit('place-data', emitParam);
  searchTerm.value.query = '';
  searchTerm.value.results = null;
}
</script>

<template>
  <div>
    <!-- search field -->
    <form>
      <div class="bg-white border border-gray-600/30 rounded-lg shadow-lg flex items-center">
        <i class="fa-solid fa-magnifying-glass p-2 text-gray-600"></i>
        <input
          type="text"
          placeholder="Search for a place"
          class="rounded-r-lg p-2 border-0 outline-0 focus:ring-2 focus:ring-gray-600 ring-inset w-full"
          v-model="searchTerm.query"
          @input="handleSearch"
        />
      </div>
    </form>
    <!-- search suggestions -->
    <div class="bg-white my-2 rounded-lg shadow-lg">
      <div v-if="searchTerm.results !== null">
        <div v-for="place in searchTerm.results" :key="place.id">
          <button
            @click="getWeather(place)"
            class="px-3 my-2 hover:text-gray-600 hover:font-bold w-full text-left"
          >
            {{ place.city }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
