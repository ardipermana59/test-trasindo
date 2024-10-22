<script setup>
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage()

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <nav
        class="fixed top-0 z-50 w-full bg-main sm:bg-white text-white sm:text-gray-900 dark:text-gray-400 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <Link href="/" class="flex ms-2 md:me-24">
                    <img src="/logo.png" class="h-8 me-3" alt="Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">{{
                        page.props.app.app_name }}</span>
                    </Link>
                </div>

                <div class="flex items-center">
                    <ThemeToggle />
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button" data-tooltip-target="user-toggle"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full" :src="$page.props.auth.user.profile_photo_url"
                                    alt="user photo">
                            </button>
                            <div id="user-toggle" role="tooltip"
                                class="absolute z-10 inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm tooltip opacity-0 invisible"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1330px, 63px);"
                                data-popper-placement="bottom">
                                {{ $page.props.auth.user.name }}
                                <div class="tooltip-arrow" data-popper-arrow=""
                                    style="position: absolute; left: 0px; transform: translate(69px, 0px);"></div>
                            </div>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ $page.props.auth.user.name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ $page.props.auth.user.email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <Link :href="route('profile.show')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Profile</Link>
                                </li>
                                <li>
                                    <Link :href="route('profile.security')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Security</Link>
                                </li>
                                <li>
                                    <form @submit.prevent="logout">
                                        <button
                                            class="text-left cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white w-full"
                                            type="submit">
                                            Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>