<script setup>
defineProps({
  place: {
    type: Object,
    default: () => ({}),
  },
})
</script>

<template>
  <div
    class="absolute bg-white/80 backdrop-blur-sm text-slate-900 inset-x-0 bottom-0 rounded-t-lg p-8"
  >
    <!-- Close button -->
    <div class="flex justify-end mb-10">
      <button @click="$emit('close-info')" class="p-1">
        <i class="fa-solid fa-xmark text-xl"></i>
      </button>
    </div>

    <div class="flex items-center justify-between gap-6 mb-20">
      <!-- Wind speed -->
      <div class="text-center flex-1">
        <i class="fa-solid fa-wind mb text-2xl"></i>
        <p class="text-xl font-bold">{{ place[0].wind.speed }} km/h</p>
        <p>wind</p>
      </div>
      <!-- Humidity level -->
      <div class="text-center flex-1">
        <i class="fa-solid fa-droplet mb text-2xl"></i>
        <p class="text-xl font-bold">{{ place[0].main.humidity }}%</p>
        <p>humidity</p>
      </div>
      <!-- Precipitation -->
      <div class="text-center flex-1">
        <i class="fa-solid fa-umbrella mb text-2xl"></i>
        <p class="text-xl font-bold">{{ place[0].main.pressure }} mm</p>
        <p>pressure</p>
      </div>
    </div>
    <div class="flex items-center justify-between gap-6 mb-10">
      <!-- Wind direction -->
      <div class="text-center flex-1">
        <i class="fa-solid fa-fan mb text-2xl"></i>
        <p class="text-xl font-bold">{{ place[0].wind.gust }}</p>
        <p>Gust</p>
      </div>
      <!-- Feels like -->
      <div class="text-center flex-1">
        <i class="fa-solid fa-temperature-half mb text-2xl"></i>
        <p class="text-xl font-bold">{{ Math.round(place[0].main.feels_like - 273.15) }}&deg;</p>
        <p>Feels</p>
      </div>
      <!-- UV -->
      <div class="text-center flex-1">
        <i class="fa-solid fa-eye mb text-2xl"></i>
        <p class="text-xl font-bold">{{ place[0].visibility }}</p>
        <p>Visibility</p>
      </div>
    </div>
    <!-- delete -->
    <div class="flex justify-between items-center">
      <button @click="$emit('remove-place')">
        <i class="fa-solid fa-trash"></i>
      </button>
    </div>
  </div>
</template>
