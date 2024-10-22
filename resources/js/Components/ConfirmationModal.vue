<script setup>
import Modal from './Modal.vue';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  isLoading: {
    type: Boolean,
    default: false
  },
  show: Boolean,
  title: {
    type: String,
    default: 'Default title'
  },
  confirmButtonText: {
    type: String,
    default: 'Yes'
  },
  cancelButtonText: {
    type: String,
    default: 'Cancel'
  }
});

const emit = defineEmits(['close', 'confirm']);

const close = () => {
  emit('close');
};

const confirm = () => {
  emit('confirm');
};
</script>

<template>
  <Modal :show="show" @close="close">
    <div class="text-center mb-8">
      <!-- Icon Slot -->
      <slot name="icon">
        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
      </slot>

      <!-- Title Slot or Default Title -->
      <slot name="title">
        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400 px-3">
          {{ title }}
        </h3>
      </slot>
      <div class="px-5 sm:px-10 mb-5 text-gray-500 dark:text-gray-400">
        <slot/>
      </div>
      <!-- Actions Slot -->
      <slot name="actions">
        <button @click="confirm" :disabled="isLoading" :class="{ 'opacity-25': isLoading }" type="button"
          class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
          {{ isLoading ? 'Loading...' : confirmButtonText }}
        </button>
        <button @click="close" :disabled="isLoading" :class="{ 'opacity-25': isLoading }" type="button"
          class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
          {{ cancelButtonText }}
        </button>
      </slot>
    </div>
  </Modal>
</template>
