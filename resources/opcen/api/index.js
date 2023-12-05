import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api',
    withCredentials: true,
});

const healthFacilityUrl = '/health-facility';

export default {
    getUser() {
        return apiClient.get('/user');
    },
    getFacilities() {
        return apiClient.get(healthFacilityUrl);
    },
    createFacility(data) {
        return apiClient.post(healthFacilityUrl, data);
    },
    updateFacility(data) {
        return apiClient.put(`${healthFacilityUrl}/${data.id}`, data);
    },
    deleteFacility(id) {
        return apiClient.delete(`${healthFacilityUrl}/${id}`)
    }
};