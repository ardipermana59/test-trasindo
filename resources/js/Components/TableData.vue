<script setup>
import { defineProps } from 'vue';

import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    data: Object,
});

</script>
<template>
    <div>
        <div class="flex flex-col mt-6">
            <div class="overflow-x-auto rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">

                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <slot name="head" />

                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                <slot name="body" />
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <Pagination :current-page="data.current_page" :last-page="data.last_page" :per-page="data.per_page"
            :total="data.total" :prev-page-url="data.prev_page_url" :next-page-url="data.next_page_url" />
    </div>
</template>
