
<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  currentPage: Number,
  lastPage: Number,
  perPage: Number,
  total: Number,
  prevPageUrl: String,
  nextPageUrl: String
});

const start = computed(() => (props.currentPage - 1) * props.perPage + 1);
const end = computed(() => Math.min(props.currentPage * props.perPage, props.total));

const pages = computed(() => {
  let pagesArray = [];
  for (let i = 1; i <= props.lastPage; i++) {
    pagesArray.push(i);
  }
  return pagesArray;
});
</script>

<template>
  <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row items-center md:space-y-0" aria-label="Table navigation">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
      Showing
      <span class="font-semibold text-gray-900 dark:text-white">{{ start }}-{{ end }}</span>
      of
      <span class="font-semibold text-gray-900 dark:text-white">{{ total }}</span>
    </span>
    <ul class="inline-flex items-stretch -space-x-px">
      <li>
        <Link
          v-if="prevPageUrl"
          :href="prevPageUrl"
          class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          aria-disabled="!prevPageUrl"
        >
          <span class="sr-only">Previous</span>
          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </Link>
      </li>
      <li v-for="page in pages" :key="page">
        <Link
          :href="`?page=${page}`"
          :class="[
            'flex items-center justify-center px-3 py-2 text-sm leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
            { 'bg-primary-50 text-primary-600 border-primary-300 dark:bg-gray-100': page === currentPage }
          ]"
          :aria-current="page === currentPage ? 'page' : undefined"
        >
          {{ page }}
        </Link>
      </li>
      <li>
        <Link
          v-if="nextPageUrl"
          :href="nextPageUrl"
          class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          aria-disabled="!nextPageUrl"
        >
          <span class="sr-only">Next</span>
          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </Link>
      </li>
    </ul>
  </nav>
</template>