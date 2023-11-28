<template>
    <div class="flex flex-col md:flex-row h-auto md:h-[70vh] border border-gray-200">
        <!-- Dispatch Information -->
        <div class="w-full md:w-1/3 overflow-y-auto">
            <div class="p-4">
                <div>
                  <b>Request Date: </b> 2023-Nov-28
                  <!-- Patient Info -->
                  <div class="text-md font-bold border-b border-red-500 pb-2 my-2">Patient Info:</div>
                  <div class="text-sm text-gray-200 mb-4">
                      <b>Patient ID:</b> 234
                      <br>
                      <b>Requester Name:</b> Juan Dela Cruz
                      <br>
                      <b>Chief complaints:</b>
                      <br>
                      Vehicular accident
                      <br>
                      <b>Remarks:</b>
                      <br>
                      Patient is unconscious with multiple bruises on the body. 
                      <br>
                  </div>
                  <!-- Status -->
                  <div class="text-md font-bold border-b border-red-500 pb-2 mb-2">Status:</div>
                  <div class="mb-4 p-2 bg-gray-700 rounded-lg inline-block">Pending</div>
                  <!-- Transport Info -->
                  <div class="text-md font-bold border-b border-red-500 pb-2 mb-2">Transport Info:</div>
                  <div class="text-sm text-gray-200 pb-2">
                      <b>Category:</b> Emergency Dispatch (Trauma)
                      <br>
                      <b>Type:</b> Dispatch type here
                      <br>
                      <b>Transport From:</b> Location A
                      <br>
                      <b>Transport To:</b> Location B
                      <br>
                      <b>Responder:</b> Squad Eagle <a class="text-yellow-500 hover:text-red-500 cursor-pointer">
                        <font-awesome-icon :icon="['fas', 'eye']" /></a>
                      <br>
                  </div>
                </div>
              </div>
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