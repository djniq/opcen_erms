import { defineStore } from 'pinia'
import { state } from './state'
import { getters } from './getters'
import api from '@/api';
import { notify } from '@kyvg/vue3-notification';

export const useHealthFacilityStore = defineStore('healthFacilityStore', {
    state: state,
    getters: getters,
    actions: {
        async loadFacilities() {
            this.loadingFacilities = true;
            await api.getFacilities().then(response => {
                this.facilities = response.data.data;
                return this.facilities;
            }).finally(() => {
                this.loadingFacilities = false;
            });
        },
        async createFacility(form) {
            await api.createFacility(form).then(response => {
                this.loadFacilities();
                return response.data;
            }).catch((e) => {
                console.error(e.response.data);
                notify({
                    type: "error",
                    text: e.response.data.message
                  })
                  return null;
            });
        },
        async updateFacility(form) {
            await api.updateFacility(form).then(response => {
                this.loadFacilities();
                return response;
            }).catch((e) => {
                console.error(e.response.data);
                notify({
                    type: "error",
                    text: e.response.data.message
                  })
                  return null;
            });
        }
    }
});