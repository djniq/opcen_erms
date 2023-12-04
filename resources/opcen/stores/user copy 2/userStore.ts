import { defineStore } from 'pinia'
import { state } from './state'
import { getters } from './getters'
import { actions } from './actions'
import { createPinia } from 'pinia'
const piniaInstance = createPinia()

const useUser = defineStore('userStore', {
    state: state,
    getters: getters,
    actions: actions
});

export const useUserStore = useUser;