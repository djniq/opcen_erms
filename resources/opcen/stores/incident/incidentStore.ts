import { defineStore } from 'pinia'
import { state } from './state'
import { getters } from './getters'
import api from '@/api';
import { notify } from '@kyvg/vue3-notification';

export const useIncidentStore = defineStore('incidentStore', {
    state: state,
    getters: getters,
    actions: {
        async loadIncidents() {
            this.loadingIncidents = true;
            await api.getIncidents().then(response => {
                this.incidents = response.data.data;
                return this.incidents;
            }).finally(() => {
                this.loadingIncidents = false;
            });
        },
        async createIncident(form, successCallback, errorCallback) {
            this.processingIncident = true;
            await api.createIncident(form).then(response => {
                this.loadIncidents();
                successCallback('New incident record created!');
                return response.data;
            }).catch((e) => {
                console.error(e.response.data);
                notify({
                    type: "error",
                    text: e.response.data.message
                  })
                  errorCallback(e);
                  return null;
            }).finally(() => {
                this.processingIncident = false;
            });
        },
        async updateIncident(form, successCallback, errorCallback) {
            this.processingIncident = true;
            await api.updateIncident(form).then(response => {
                this.loadIncidents();
                successCallback('Incident record updated!');
                return response;
            }).catch((e) => {
                errorCallback(e);
                return null;
            }).finally(() => {
                this.processingIncident = false;
            });
        },
        async deleteIncident(id, successCallback, errorCallback) {
            this.processingIncident = true;
            await api.deleteIncident(id).then(response => {
                this.loadIncidents();
                successCallback('Incident record deleted!');
                return response;
            }).catch((e) => {
                errorCallback(e);
                return null;
            }).finally(() => {
                this.processingIncident = false;
            });
        }
    }
});