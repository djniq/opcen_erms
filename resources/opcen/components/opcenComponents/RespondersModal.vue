<template>
    <modal v-if="openModal" @close-modal="openModal = false;">
        <template #modalTitle>
            Responders
        </template>
        <template #modalBody>
            <div class="flex flex-col">
                <div class="text-md font-semibold">
                    Squad Eagle
                </div>
                <div class="text-s">
                    <b>Leader: </b> Leed Erborg
                </div>
                <div class="text-sm">
                    <b>Members:</b>
                    <div>Han Duet</div>
                    <div>Charlie Pink</div>
                </div>
            </div>
        </template>
    </modal>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import Modal from '../Modal.vue';

const props = defineProps({
    openResponderModal: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits<{
  (e: "update:openResponderModal", value: Boolean): void;
}>();

const openModal = computed<boolean>({
    get() {
        return props.openResponderModal;
    },
    set(newValue) {
        emit("update:openResponderModal", newValue);
    }
})

</script>

<style scoped>

</style>