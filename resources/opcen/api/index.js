import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api',
    withCredentials: true,
});

const userUrl = '/user';
const healthFacilityUrl = '/health-facility';
const ambulanceUrl = '/ambulance';
const driverUrl = '/driver';
const incidentUrl = '/incident';

export default {
    // User
    getUser() {
        return apiClient.get(userUrl);
    },
    getUsers() {
        return apiClient.get(`${userUrl}/list`);
    },
    createUser(data) {
        return apiClient.post(userUrl, data);
    },
    updateUser(data) {
        return apiClient.put(`${userUrl}/${data.id}`, data);
    },
    deleteUser(id) {
        return apiClient.delete(`${userUrl}/${id}`)
    },

    // Health Facility
    getFacilities() {
        return apiClient.get(healthFacilityUrl);
    },
    getFacilityAssetCounters() {
        return apiClient.get(`${healthFacilityUrl}/counters`);
    },
    getFacilityAssetCountersEach(facilityId) {
        return apiClient.get(`${healthFacilityUrl}/counters/${facilityId}`);
    },
    getFacilityOptions() {
        return apiClient.get(`${healthFacilityUrl}/options`);
    },
    createFacility(data) {
        return apiClient.post(healthFacilityUrl, data);
    },
    updateFacility(data) {
        return apiClient.put(`${healthFacilityUrl}/${data.id}`, data);
    },
    deleteFacility(id) {
        return apiClient.delete(`${healthFacilityUrl}/${id}`)
    },

    // Ambulances
    getAmbulances() {
        return apiClient.get(ambulanceUrl);
    },
    createAmbulance(data) {
        return apiClient.post(ambulanceUrl, data);
    },
    updateAmbulance(data) {
        return apiClient.put(`${ambulanceUrl}/${data.id}`, data);
    },
    deleteAmbulance(id) {
        return apiClient.delete(`${ambulanceUrl}/${id}`)
    },

    // Drivers
    getDrivers() {
        return apiClient.get(driverUrl);
    },
    createDriver(data) {
        return apiClient.post(driverUrl, data);
    },
    updateDriver(data) {
        return apiClient.put(`${driverUrl}/${data.id}`, data);
    },
    deleteDriver(id) {
        return apiClient.delete(`${driverUrl}/${id}`)
    },

    // Incident
    getIncidents() {
        return apiClient.get(incidentUrl);
    },
    createIncident(data) {
        return apiClient.post(incidentUrl, data);
    },
    updateIncident(data) {
        return apiClient.put(`${incidentUrl}/${data.id}`, data);
    },
    deleteIncident(id) {
        return apiClient.delete(`${incidentUrl}/${id}`)
    },
};