<template>
    <GMapMap
      :center="{ lat: 16.4011, lng: 120.5957 }"
      :zoom="17" 
      map-type-id="terrain" 
      style="width: 100%; height: 100%"
      class="h-full"
      :options="{
        zoomControl: true,
        mapTypeControl: true,
        scaleControl: true,
        streetViewControl: true,
        rotateControl: true,
        fullscreenControl: true
      }"
    />
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>