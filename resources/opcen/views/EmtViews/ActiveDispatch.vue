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
                  </div>
                </div>
              </div>
              <!-- Status -->
              <div class="w-full flex items-center justify-center p-5">
                <button class="p-2 bg-blue-600 rounded-lg" v-if="dispatchStatus===1" @click="dispatchStatus = 2">Start</button>
                <button class="p-2 bg-blue-600 rounded-lg"  v-if="dispatchStatus===2" @click="dispatchStatus = 3">Arrived</button>
                <button class="p-2 bg-blue-600 rounded-lg"  v-if="dispatchStatus===3" @click="dispatchStatus = 4">Move out from site</button>
                <button class="p-2 bg-blue-600 rounded-lg"  v-if="dispatchStatus===4" @click="dispatchStatus = 5">Arrived to facility</button>
                <button class="p-2 bg-blue-600 rounded-lg"  v-if="dispatchStatus===5" @click="dispatchStatus = 6">Endorse patient</button>
                <button class="p-2 bg-blue-600 rounded-lg"  v-if="dispatchStatus===6" @click="completeDispatch()">Back to HQ/End</button>
              </div>
        </div>
        <!-- Dispatch Map -->
        <div class="w-full md:w-3/4">
            <Map />
        </div>
        <notifications position="bottom center" />
    </div>
</template>

<script setup lang="ts">
import Map from '@/components/map/Map.vue';
import { notify } from '@kyvg/vue3-notification';
import { ref } from 'vue';

const dispatchStatus = ref(1);

const completeDispatch = () => {
  notify({
    text: "Dispatch Completed!",
    type: "success"
  });
}

</script>

<style scoped>

</style>