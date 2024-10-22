<script setup>
import { usePage, Link } from '@inertiajs/vue3';

const page = usePage()
const user = page.props.auth.user

</script>
<template>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800 space-y-1 bg-white scrollbar-hide">
            <ul v-if="user.role == 'merchant'" class="pb-2 space-y-2 font-medium">
                <span class="ml-3 font-light text-gray-400 dark:text-gray-200">Merchant</span>
                <li>
                    <Link :href="route('dashboard')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/dashboard') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('merchant.menus.index')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/merchant/menus') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h10a1 1 0 011 1v2H3V3zM2 7h16v10a1 1 0 01-1 1H3a1 1 0 01-1-1V7zm3 2a1 1 0 100 2h8a1 1 0 100-2H5z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Data Menu</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('merchant.orders.index')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/merchant/orders') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4" />
                    </svg>
                    <span class="ml-3">Daftar Pesanan</span>
                    </Link>
                </li>
            </ul>
            <ul v-if="user.role == 'customer'" class="pb-2 space-y-2 font-medium">
                <span class="ml-3 font-light text-gray-400 dark:text-gray-200">Customer</span>
                <li>
                    <Link :href="route('dashboard')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/dashboard') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('customer.caterings.index')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/customer/caterings') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h10a1 1 0 011 1v2H3V3zM2 7h16v10a1 1 0 01-1 1H3a1 1 0 01-1-1V7zm3 2a1 1 0 100 2h8a1 1 0 100-2H5z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Daftar Katering</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('customer.orders.index')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/customer/orders') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4" />
                    </svg>
                    <span class="ml-3">Daftar Pesanan</span>
                    </Link>
                </li>
            </ul>

            <ul class="pb-2 space-y-2 font-medium">
                <span class="ml-3 font-light text-gray-400 dark:text-gray-200">Settings</span>
                <li>
                    <Link :href="route('profile.show')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/user/profile') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ml-3">Profile</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('profile.security')"
                        :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url.includes('/user/security') }"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg>
                    <span class="ml-3">Security</span>
                    </Link>
                </li>
            </ul>


        </div>
    </aside>
</template>