<script setup>
import { ref } from 'vue';

const emit = defineEmits(['place-data']);

const searchTerm = ref({
  query: '',
  timeout: null,
  results: null,
});

const API = `fsq3IdBSShFekw5FiD62DV8Z4q/eCHdyxU1Ms6hPS+H/RUY=`;

const options = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'fsq3vpdrnjzIEtE/cZOSj9QyQUyRvuWPKpvxbovxizlwPVM='
  }
};

const handleSearch = () => {
  clearTimeout(searchTerm.value.timeout)
  searchTerm.value.timeout = setTimeout(async () => {
    if (searchTerm.value.query !== '') {
      const res = await fetch(
        `https://api.foursquare.com/v3/autocomplete?query=${searchTerm.value.query}&ll=36.2048,138.2529`, options
      )

      const data = await res.json()
      console.log(data);
      searchTerm.value.results = data.results
    } else {
      searchTerm.value.results = null
    }
  }, 500)
}

const getWeather = async (id) => {
  const res = await fetch(
    `http://api.weatherapi.com/v1/forecast.json?key=[YOUR_API_KEY]=id:${id}&days=3&aqi=no&alerts=no`
  )

  const data = await res.json()

  emit('place-data', data)

  searchTerm.value.query = ''
  searchTerm.value.results = null
}
</script>

<template>
  <div>
    <!-- search field -->
    <form>
      <div class="bg-white border border-amber-600/30 rounded-lg shadow-lg flex items-center">
        <i class="fa-solid fa-magnifying-glass p-2 text-amber-600"></i>
        <input
          type="text"
          placeholder="Search for a place"
          class="rounded-r-lg p-2 border-0 outline-0 focus:ring-2 focus:ring-amber-600 ring-inset w-full"
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
            @click="getWeather(place.id)"
            class="px-3 my-2 hover:text-amber-600 hover:font-bold w-full text-left"
          >
            {{ place.text.primary }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
