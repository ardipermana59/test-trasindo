<script setup>
import { Link } from "@inertiajs/vue3";

</script>
<template>
    <div class="bg-main fixed inset-x-0 bottom-0 sm:absolute">
        <div class="text-zinc-200 grid grid-cols-5 text-md">

            <Link :href="route('dashboard')" :class="{ 'bg-[#2020df] rounded-full': $page.url.includes('/dashboard') }"
                class="active:bg-[#f2f2f2] active:rounded-full">
            <div
                class="align-middle text-center cursor-pointer py-2 rounded-full transition duration-200 ease-in-out hover:bg-[#2020df] hover:bg-opacity-75 active:bg-[#2020df] active:bg-opacity-50 focus:bg-[#2020df] focus:bg-opacity-90">
                <div class="font-semibold text-zinc-200">
                    <svg class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </div>
            </div>

            </Link>

            <Link :href="route('transaction.histories')"
                :class="{ 'bg-[#2020df] rounded-full': $page.url.includes('/transaction/history') }"
                class="active:bg-[#f2f2f2] active:rounded-full">
            <div
                class="align-middle text-center cursor-pointer py-2 rounded-full transition duration-200 ease-in-out hover:bg-[#2020df] hover:bg-opacity-75 active:bg-[#2020df] active:bg-opacity-50 focus:bg-[#2020df] focus:bg-opacity-90">
                <div class="font-semibold text-zinc-200">
                    <svg class="h-6 w-6 mx-auto" width="26" height="26" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="16 3 20 7 16 11" />
                        <line x1="10" y1="7" x2="20" y2="7" />
                        <polyline points="8 13 4 17 8 21" />
                        <line x1="4" y1="17" x2="13" y2="17" />
                    </svg>
                    <p>Transaksi</p>
                </div>
            </div>
            </Link>
            <Link :href="route('balances.index')" :class="{ 'bg-[#2020df] rounded-full': $page.url.includes('/saldo') }" class="active:bg-[#f2f2f2] active:rounded-full">
            <div
                class="align-middle text-center cursor-pointer py-2 rounded-full transition duration-200 ease-in-out hover:bg-[#2020df] hover:bg-opacity-75 active:bg-[#2020df] active:bg-opacity-50 focus:bg-[#2020df] focus:bg-opacity-90">
                <div class="font-semibold text-zinc-200">
                    <svg class="h-6 w-6 mx-auto" width="26" height="26" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                        <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                    </svg>
                    <p>Saldo</p>
                </div>
            </div>
            </Link>
            <Link :href="route('member.information.index')" class="active:bg-[#f2f2f2] active:rounded-full">
            <div
                class="align-middle text-center cursor-pointer py-2 rounded-full transition duration-200 ease-in-out hover:bg-[#2020df] hover:bg-opacity-75 active:bg-[#2020df] active:bg-opacity-50 focus:bg-[#2020df] focus:bg-opacity-90">
                <div class="font-semibold text-zinc-200">
                    <svg class="h-6 w-6 mx-auto" width="26" height="26" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                    </svg>
                    <p>Informasi</p>
                </div>
            </div>
            </Link>

            <Link :href="route('profile.show')" class="active:bg-[#f2f2f2] active:rounded-full">
            <div
                class="align-middle text-center cursor-pointer py-2 rounded-full transition duration-200 ease-in-out hover:bg-[#2020df] hover:bg-opacity-75 active:bg-[#2020df] active:bg-opacity-50 focus:bg-[#2020df] focus:bg-opacity-90">
                <div class="font-semibold text-zinc-200">
                    <svg class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>

                    <p>Profile</p>
                </div>
            </div>
            </Link>
        </div>
    </div>
</template>
