<script setup>
defineProps({
  weather: Object,
});

const formatDateHour = (dateString) => {
  const date = new Date(dateString);
  let hours = date.getHours();
  const minutes = String(date.getMinutes()).padStart(2, '0');
  let meridiem = ' AM';

  if (hours >= 12) {
    meridiem = ' PM';
  }
  if (hours > 12) {
    hours -= 12;
  }
  if (hours === 0) {
    hours = 12;
  }

  return `${hours}:${minutes}${meridiem}`;
}

const convertKelvinToCelcius = (temperature) => {
  return Math.round(temperature - 273.15)
}
</script>

<template>
  <div class="mt-10 mb-10 items-center justify-between">
    <span class="font-semibold text-lg">{{ convertKelvinToCelcius(weather.main.temp) }}&deg;C</span>
    <img
      :src="'https://openweathermap.org/img/wn/' + weather.weather[0].icon + '@2x.png'"
      alt="icon"
      width="50"
      class="mt-3 mb-3"
    />
    <span class="font-semibold mt-1 text-sm">{{ formatDateHour(weather.dt_txt) }}</span>
  </div>
</template>
