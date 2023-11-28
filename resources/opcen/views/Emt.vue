<template>
  <div class="w-full px-2 md:px-5">
    <div class="pb-4">
      <div>Total # of Response: {{ responseCount }}</div>
      <div>Emergency Case: {{ responseCount }}</div>
    </div>
    <TabMenu :tab-items="tabItems" />
    <RouterView />
  </div>
</template>

<script setup lang="ts">
import TabMenu from '@/components/layout/TabMenu.vue';
import { SubMenuItem } from '@/models/Tab';
import { ref } from 'vue';

const responseCount = 0;

const tabItems = ref<SubMenuItem[]>([
  {
    path: '/emt',
    name: 'Active Dispatch',
    label: 'Active'
  },
  {
    path: '/emt/dispatch-history',
    name: 'Dispatch History',
    label: 'Previous Assignments'
  },
])

</script>

<style scoped></style>