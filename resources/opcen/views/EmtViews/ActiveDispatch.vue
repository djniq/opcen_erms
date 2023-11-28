<template>
    <div class="flex flex-col md:flex-row h-auto md:h-[60vh] border border-gray-200">
        <!-- Dispatch Information -->
        <div class="w-full md:w-1/3">
            Dispatch Info Here
        </div>
        <!-- Dispatch Map -->
        <div class="w-full md:w-3/4">
            <Map />
        </div>
    </div>
</template>

<script setup lang="ts">
import Map from '@/components/map/Map.vue';


</script>

<style scoped>

</style>