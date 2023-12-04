import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api',
    withCredentials: true,
});

export default {
    getUser() {
        return apiClient.get('/user');
    },
    getFacilities() {
        return apiClient.get('/health-facility');
    },
    createFacility(data) {
        return apiClient.post('/health-facility', data);
    },
    updateFacility(data) {
        return apiClient.put(`/health-facility/${data.id}`, data);
    }
};