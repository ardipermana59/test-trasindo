<script setup>
import { defineProps } from 'vue';
import { Head } from "@inertiajs/vue3";

import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import MainCard from '@/Components/MainCard.vue';
import TableData from '@/Components/TableData.vue';
import SearchInput from '@/Components/SearchInput.vue';

import UpdateMenu from './UpdateMenu.vue';

const props = defineProps({
    data: Object,
    search: String
});
</script>
<template>
    <AppLayout>

        <Head title="Daftar Order" />
        <Breadcrumb current-page="Daftar Order" page-title="Daftar Order" />

        <div class="px-4">
            <MainCard>
                <!-- Card header -->
                <div class="items-center justify-between">
                    <div class="sm:flex">
                        <div
                            class="items-center justify-between mb-3 flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                            <SearchInput :search="search" routeName="merchant.menus.index" />
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <TableData :data="data">
                    <template #head>
                        <tr>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Customer
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Menu
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Jumlah Pesanan
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Tanggal
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Status
                            </th>
                            <th scope="col"
                                class="p-4 w-10 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white text-center">
                                Actions
                            </th>
                        </tr>
                    </template>
                    <template #body>
                        <tr v-if="data.data.length > 0" v-for="order in data.data" :key="order.id"
                            class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ order.customer.company_name }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ order.menu.name }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ order.quantity }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ order.delivery_date }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <span :class="{
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': order.status === 'pending',
                                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300': order.status === 'proses',
                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': order.status === 'selesai',
                                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': order.status === 'batal'
                                }" class="px-2 py-1 text-sm font-semibold rounded-full">
                                    {{ order.status }}
                                </span>
                            </td>

                            <td class="p-4 space-x-1 whitespace-nowrap flex">
                                <UpdateMenu :order="order" />
                            </td>
                        </tr>
                        <tr v-else class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                colspan="4">
                                No data
                            </td>
                        </tr>
                    </template>
                </TableData>
            </MainCard>
        </div>
    </AppLayout>
</template>