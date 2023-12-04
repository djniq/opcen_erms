<template>
    <modal v-if="openModal" @close-modal="openModal = false;">
        <template #modalTitle>
            Create New Health Facility
        </template>
        <template #modalBody>
            <form class="mx-auto" @submit.prevent="handleSubmit()">
                <div class="px-4">
                    <div class="relative z-0 w-full mb-5 group">
                        <input 
                            type="text" 
                            name="floating-facility-name"
                            id="floating-facility-name"
                            v-model="healthFacilityForm.name"
                            class="block py-2.5 px-0 w-full text-sm border-0 border-b-2 appearance-none bg-transparent text-white border-gray-600 focus:border-yellow-500 focus:outline-none focus:ring-0 peer" placeholder=" " required />
                        <label
                            for="floating-facility-name"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-yellow-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >Health Facility Name</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input 
                            type="email" 
                            v-model="healthFacilityForm.email"
                            name="floating-facility-email" 
                            id="floating-facility-email" 
                            class="block py-2.5 px-0 w-full text-sm border-0 border-b-2 appearance-none bg-transparent text-white border-gray-600 focus:border-yellow-500 focus:outline-none focus:ring-0 peer" placeholder=" " required />
                        <label
                            for="floating-facility-email"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-yellow-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >Email</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input 
                            type="text" 
                            v-model="healthFacilityForm.contactNo"
                            name="floating-contact-no" 
                            id="floating-contact-no" 
                            class="block py-2.5 px-0 w-full text-sm border-0 border-b-2 appearance-none bg-transparent text-white border-gray-600 focus:border-yellow-500 focus:outline-none focus:ring-0 peer" placeholder=" " required />
                        <label
                            for="floating-contact-no"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-yellow-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >Contact No.</label>
                    </div>
                </div>
                <div class="px-4 mb-8 space-y-4">
                    <div class="text-gray-400 text-sm">
                        Health Facility Level
                    </div>
                    <label
                        for="level-select"
                        class="sr-only"
                    >
                        Health Facility Level
                    </label>
                    <select
                        v-model="healthFacilityForm.level"
                        id="level-select"
                        class="font-medium border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-white text-white ring-blue-500 focus:border-blue-500"   
                        required
                    >
                        <option value="" disabled selected>Select Level</option>
                        <option value="primary">Primary</option>
                        <option value="secondary">Secondary</option>
                        <option value="tertiary">Tertiary</option>
                        <option value="specialized">Specialized</option>
                    </select>
                </div>
                <div class="px-4">
                    <AddressSelection
                        v-model:form-address="healthFacilityForm.address"
                        required
                    />
                </div>
                <div class="flex justify-end space-x-4">
                    <action-button
                        type="submit"
                    >
                        Save
                    </action-button>
                    <button
                        type="button"
                        class="text-white bg-red-500 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                        @click="openModal = false"
                    >Cancel</button>
                </div>
                
            </form>
        </template>
        
    </modal>
</template>

<script setup lang="ts">
import { PropType, computed, onMounted, ref, watch } from 'vue';
import Modal from '../Modal.vue';
import ActionButton from '../form/ActionButton.vue';
import AddressSelection from '../map/AddressSelection.vue';
import { useHealthFacilityStore } from '@/stores/healthFacility/healthFacilityStore';
import { Facility } from '@/models/FacilityModel';

const props = defineProps({
    openCreateModal: {
        type: Boolean,
        default: false
    },
    facility: {
        type: Object as PropType<Facility>,
        default: null
    }
})

const facilityStore = useHealthFacilityStore();

const mode = computed(() => {
    return props.facility ? 'update' : 'create'
})

const emit = defineEmits<{
  (e: "update:openCreateModal", value: Boolean): void;
}>();

const openModal = computed<boolean>({
    get() {
        return props.openCreateModal;
    },
    set(newValue) {
        emit("update:openCreateModal", newValue);
    }
})

const defaultFormValues: Facility = {
    name: '',
    level: '',
    email: '',
    contactNo: '',
    address: undefined
};

const healthFacilityForm = ref(defaultFormValues);

const handleSubmit = async () => {
    try {
        let save = mode.value === 'create' 
            ? await facilityStore.createFacility(healthFacilityForm.value)
            : await facilityStore.updateFacility(healthFacilityForm.value).then(response => {
                console.log(response);
                if (response.status == 200) {
                    closeAndResetModal();
                }
            });
    } catch (error) {
        console.error(error);
    }
}

const closeAndResetModal = () => {
    healthFacilityForm.value = defaultFormValues;
    openModal.value = false;
}

watch(mode, (newVal) => {
    if(mode.value === 'update') {
        healthFacilityForm.value = props.facility;
    } else {
        healthFacilityForm.value = defaultFormValues;
    }
}, {deep: true})
</script>

<style>
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    transition: background-color 5000s ease-in-out 0s;
    -webkit-text-fill-color: #fff !important;
} </style>
