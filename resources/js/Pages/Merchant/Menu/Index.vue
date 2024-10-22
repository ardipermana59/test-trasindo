<script setup>
import { defineProps } from 'vue';
import { Head } from "@inertiajs/vue3";

import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import MainCard from '@/Components/MainCard.vue';
import TableData from '@/Components/TableData.vue';
import SearchInput from '@/Components/SearchInput.vue';

import AddMenu from './AddMenu.vue';
import UpdateMenu from './UpdateMenu.vue';
import DeleteData from '@/Pages/Crud/DeleteData.vue';
import { formatCurrency } from '@/Utils/formatCurrency';

const props = defineProps({
    data: Object,
    types: Object,
    search: String
});
</script>
<template>
    <AppLayout>

        <Head title="Data Menu" />
        <Breadcrumb current-page="Menu" page-title="Data Menu" />

        <div class="px-4">
            <MainCard>
                <!-- Card header -->
                <div class="items-center justify-between">
                    <div class="sm:flex">
                        <div
                            class="items-center justify-between mb-3 flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                            <SearchInput :search="search" routeName="merchant.menus.index" />
                        </div>
                        <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                            <AddMenu :types="types"/>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <TableData :data="data">
                    <template #head>
                        <tr>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Foto
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Tipe
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Nama Menu
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Harga Satuan
                            </th>
                            <th scope="col"
                                class="p-4 w-10 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white text-center">
                                Actions
                            </th>
                        </tr>
                    </template>
                    <template #body>
                        <tr v-if="data.data.length > 0" v-for="menu in data.data" :key="menu.id"
                            class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <img :src="menu.photo_url" alt="Menu Photo" class="w-16 h-16 rounded-full object-cover" />

                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ menu.type.name }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ menu.name }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ formatCurrency(menu.price) }}
                            </td>
                            <td class="p-4 space-x-1 whitespace-nowrap flex">
                                 <UpdateMenu :menu="menu" :types="types"/>
                                <DeleteData :id="menu.id" routeName="merchant.menus.destroy"/>
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