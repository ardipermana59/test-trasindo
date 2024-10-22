<script setup>
import { defineProps } from 'vue';
import { Head } from "@inertiajs/vue3";

import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import MainCard from '@/Components/MainCard.vue';
import TableData from '@/Components/TableData.vue';
import SearchInput from '@/Components/SearchInput.vue';

// import AddUser from './AddUser.vue';
import UpdateUser from './UpdateUser.vue';
import DeleteData from '@/Pages/Crud/DeleteData.vue';

const props = defineProps({
    users: Object,
    search: String
});
</script>
<template>
    <AppLayout>

        <Head title="Data User" />
        <Breadcrumb current-page="User" page-title="Data User" />

        <div class="px-4">
            <MainCard>
                <!-- Card header -->
                <div class="items-center justify-between">
                    <div class="sm:flex">
                        <div
                            class="items-center justify-between mb-3 flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                            <SearchInput :search="search" routeName="users.index" />
                        </div>
                        <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                            <!-- <AddUser /> -->
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <TableData :data="users">
                    <template #head>
                        <tr>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Nama
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white text-center">
                                Email
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white text-center">
                                Role
                            </th>
                            <th scope="col"
                                class="p-4 w-10 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white text-center">
                                Actions
                            </th>
                        </tr>
                    </template>
                    <template #body>
                        <tr v-if="users.data.length > 0" v-for="user in users.data" :key="user.id"
                            class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <span v-if="user.merchant">
                                    {{ user.merchant.company_name }}
                                </span>
                                <span v-else-if="user.customer">
                                    {{ user.customer.company_name }}
                                </span>
                                <span v-else>
                                    {{ user.name }}
                                </span>
                            </td>
                            <td
                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ user.email }}
                            </td>
                            <td
                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                <span v-if="user.role === 'superadmin'"
                                    class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ user.role }}
                                </span>
                                <span v-else-if="user.role === 'member'"
                                    class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                    {{ user.role }}
                                </span>
                                <span v-else-if="user.role === 'admin'"
                                    class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    {{ user.role }}
                                </span>
                                <span v-else
                                    class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{
                                        user.role }}</span>
                            </td>
                            <td class="p-4 space-x-1 whitespace-nowrap flex">
                                <UpdateUser :user="user" />
                                <DeleteData :id="user.id" routeName="admin.users.destroy" />
                            </td>
                        </tr>
                        <tr v-else class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                colspan="7">
                                No data
                            </td>
                        </tr>
                    </template>
                </TableData>
            </MainCard>
        </div>
    </AppLayout>
</template>