<template>
  <div class="p-0 mx-auto">
    <template v-if="isLoggedIn">
      <div class="w-full">
        <top-navigation />
      </div>
    </template>
    <RouterView class="view main-content w-full"></RouterView>
  </div>
</template>

<script setup lang="ts">
import { defineAsyncComponent, onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const TopNavigation = defineAsyncComponent(() => import('@/components/layout/TopNavigation.vue'));

  const isLoggedIn = ref(false);
  const router = useRouter();

  onMounted(() => {
    if (window.Laravel.isLoggedin) {
      isLoggedIn.value = true
    } else {
      router.push({name: "Login"});
    }
  });
</script>

<style scoped></style>