<template>
  <div class="w-full h-full">
    <!-- Date range picker -->
    <div class="flex items-center justify-center pt-4 mb-4">
      <div class="w-auto pr-2 font-bold text-white">
        Select Range:
      </div>
      <div class="w-auto">
        <VueDatePicker
          v-model="dateRange"
          :range="true"
          :multi-calendars="true"
        />
      </div>
    </div>
    <!-- Transport Request Table -->
    <div class="overflow-y-auto block max-h-[67svh]">
      <table class="w-full">
        <thead class="bg-white sticky top-0">
          <tr>
            <th scope="col" class="columns-1 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              ID
            </th>
            <th scope="col" class="columns-1 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Request Date
            </th>
            <th scope="col" class="columns-2 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Patient Info
            </th>
            <th scope="col" class="columns-2 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Transport Info
            </th>
            <th scope="col" class="columns-2 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Dispatch Info
            </th>
            <th scope="col" class="columns-2 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Status
            </th>
            <th scope="col" class="columns-2 border border-gray-500 w-10 text-md font-medium text-gray-900 p-2 text-left">
              Action
            </th>
          </tr>
        </thead>
        <tbody class="overflow-y-auto">
          <tr class="border-b border-gray-100">
            <td class="p-2 border border-gray-100">000123</td>
            <td class="p-2 border border-gray-100">
              2023-Nov-28
            </td>
            <td class="p-2 border border-gray-100">
              <!-- Patient Info -->
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
            </td>
            <td class="p-2 border border-gray-100">
              <div class="text-sm text-gray-200 pb-2">
                <b>Category:</b> Emergency Dispatch (Trauma)
                <br>
                <b>Type:</b> Dispatch type here
                <br>
                <b>Transport From:</b> Location A
                <br>
                <b>Transport To:</b> Location A
                <br>
                <b>Responder:</b> Squad Eagle <a class="text-yellow-500 hover:text-red-500 cursor-pointer">
                  <font-awesome-icon :icon="['fas', 'eye']" @click="showResponders()" /></a>
                <br>
              </div>
            </td>
            <td class="p-2 border border-gray-100">
              None
            </td>
            <td class="p-2 border border-gray-100 text-center">
              <div class="mb-4 p-2 bg-gray-700 rounded-lg inline-block">Pending</div>
            </td>
            <td class="p-1 border border-gray-100">
              <button>Send Dispatch</button>
              <button>Cancel Dispatch</button>
              <button>Complete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <responders-modal v-model:open-responder-modal="openRespondersModal"></responders-modal>
  </div>
</template>

<script setup lang="ts">
import VueDatePicker from '@vuepic/vue-datepicker';
import { library } from '@fortawesome/fontawesome-svg-core';
import RespondersModal from './RespondersModal.vue';

/* add some free styles */
import { faEye } from '@fortawesome/free-solid-svg-icons'

import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue';

library.add(faEye);

const dateRange = ref(null);

const openRespondersModal = ref(false);

const showResponders = () => {
  openRespondersModal.value = true;
}
</script>

<style scoped></style>