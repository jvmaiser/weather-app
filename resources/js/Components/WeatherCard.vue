<script setup>
import { ref } from 'vue';
import WeatherForecastHour from './WeatherForecastHour.vue';
import WeatherInfo from './WeatherInfo.vue';

defineProps({
  place: {
    type: Object,
    default: () => ({}),
  },
  city: {
    type: String,
    default: '',
  },
})

const emit = defineEmits(['delete-place']);

const showDetail = ref(false);

const formatDateTime = () => {
  let date = new Date();
  let japanTime = date.getTime() + (date.getTimezoneOffset() + (9 * 60)) * 60000;
  let japanDate = new Date(japanTime);

  let month = japanDate.getMonth() + 1;
  let day = japanDate.getDate();
  let hours = japanDate.getHours();
  let minutes = ('0' + japanDate.getMinutes()).slice(-2);
  let ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12;

  return month + '/' + day + ' ' + hours + ':' + minutes + ampm;
}

const removePlace = (placeName) => {
  emit('delete-place', placeName)
  showDetail.value = false
}
</script>

<template>
  <div
    :class="place[0].sys.pod === 'd' ? 'bg-day' : 'bg-night'"
    class="text-white p-10 rounded-lg shadow-lg gap-6 mb-6 relative overflow-hidden"
  >
    <div class="mb-2 flex justify-between items-center">
      <div class="flex items-center justify-center gap-2">
        <i class="fa-solid fa-location-dot"></i>
        <h1 class="text-3xl">{{ city }}</h1>
      </div>
      <div class="flex items-center justify-center gap-2">
        <i class="fa-solid fa-clock"></i>
        <h1 class="text-3xl">
          {{ formatDateTime() }}
        </h1>
      </div>
    </div>

    <!-- current weather -->
    <div class="text-center flex-1">
      <img :src="'https://openweathermap.org/img/wn/' + place[0].weather[0].icon + '@2x.png'" alt="icon" width="200" class="mx-auto -mb-10" />
      <h1 class="text-9xl mb-2 -mr-4">{{ Math.round(place[0].main.temp - 273.15) }}&deg;</h1>
      <p class="text-2xl">{{ place[0].weather[0].main }}</p>
    </div>

    <div class="w-full h-px bg-gradient-to-r from-white/0 via-white/90 to-white/0 my-10">
    </div>

    <div class="flex justify-between mt-12">
      <div v-for="(weather, id) in place" :key="id" class="flex flex-col items-center">
        <WeatherForecastHour :weather="weather" />
      </div>
    </div>

    <!-- forecast -->
<!--    <div v-for="(weather, id) in place" :key="id">-->
<!--      <WeatherForecastHour :weather="weather" />-->
<!--    </div>-->

    <!-- info -->
    <Transition name="fade">
      <div v-show="showDetail">
        <WeatherInfo
          :place="place"
          @close-info="showDetail = false"
          @remove-place="removePlace(city)"
        />
      </div>
    </Transition>

    <!-- forecast btn -->
    <div class="flex justify-end items-center gap-1 mt-10">
      <button @click="showDetail = true">
        More <i class="fa-solid fa-arrow-right text-sm -mb-px"></i>
      </button>
    </div>
  </div>
</template>

<style scoped>
.bg-day {
  background-color: #8ec5fc;
  background-image: linear-gradient(62deg, #8ec5fc 0%, #e0c3fc 100%);
}

.bg-night {
  background-color: #07223d;
  background-image: linear-gradient(62deg, #0a2a4a 0%, #270845 100%);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
