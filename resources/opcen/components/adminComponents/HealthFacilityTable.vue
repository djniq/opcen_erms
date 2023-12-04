<template>
    <div class="p-4">
        <table class="w-full">
        <thead class="bg-white sticky top-0">
          <tr>
            <th scope="col" class="columns-1 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              ID
            </th>
            <th scope="col" class="columns-1 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Name
            </th>
            <th scope="col" class="columns-2 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Level
            </th>
            <th scope="col" class="columns-2 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Address
            </th>
            <th scope="col" class="columns-2 border border-gray-500 text-md font-medium text-gray-900 p-2 text-left">
              Contact No.
            </th>
            <th scope="col" class="columns-2 border border-gray-500 w-10 text-md font-medium text-gray-900 p-2 text-left">
              Action
            </th>
          </tr>
        </thead>
        <tbody class="overflow-y-auto">
          <template v-if="loadingFacilities">
            <tr class="border-b border-gray-100" >
              <td colspan="6" class="p-2 border border-gray-100">
                <div class="w-full flex justify-center py-5 text-white">
                  <font-awesome-icon class="animate-spin h-10 w-10" :icon="['fas', 'spinner']" />
                </div>
              </td>
              </tr>
          </template>
          <template v-else>
            <tr class="border-b border-gray-100" v-for="facility in facilities" >
              <td class="p-2 border border-gray-100">{{ facility.id }}</td>
              <td class="p-2 border border-gray-100">
                {{ facility.name }}
              </td>
              <td class="p-2 border border-gray-100">
                  {{ facility.level }}
              </td>
              <td class="p-2 border border-gray-100">
                {{ facility.address.formatted_address || '' }}
              </td>
              <td class="p-2 border border-gray-100">
                {{ facility.contactNo }}
              </td>
              <td class="p-1 border border-gray-100">
                  <div class=" flex justify-center items center space-x-3">
                      <button class="cursor-pointer" @click="updateFacility(facility)"><font-awesome-icon :icon="['fas', 'edit']" /></button>
                  </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
</template>

<script setup lang="ts">
import { useHealthFacilityStore } from '@/stores/healthFacility/healthFacilityStore';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faEdit, faSpinner } from '@fortawesome/free-solid-svg-icons';
import { storeToRefs } from 'pinia';
import {Facility} from '@/models/FacilityModel'
library.add(faEdit, faSpinner);

const {facilities, loadingFacilities} = storeToRefs(useHealthFacilityStore());

const emit = defineEmits(['open-update-modal']);

const updateFacility = (facility: Facility) => {
    emit('open-update-modal', facility);
}
</script>

<style scoped>

</style>