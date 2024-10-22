<script setup>
import { computed, defineProps } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { truncateText } from '@/Utils/truncateText';

const page = usePage();
const props = defineProps({
    informations: Object,
    showContent: false
});

const currentTime = computed(() => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date().toLocaleDateString('id-ID', options);
});

</script>
<template>
    <ol class="relative border-l-2 border-gray-200 dark:border-gray-700 md:text-base">
        <li v-if="informations.data.length > 0" v-for="information in informations.data" :key="information.id"
            class="ml-6 mb-3">
            <span
                class="flex absolute -left-4 justify-center items-center w-8 h-8 text-slate-100 font-bold bg-main rounded-full ring-white">
                i
            </span>
            <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 shadow-sm">
                <div class="mb-2 text-sm">
                    <span class="font-bold text-black dark:text-white block text-base sm:text-lg">{{ information.title
                        }}</span>
                    <time class="mb-1 font-normal text-gray-400 dark:text-gray-500 sm:order-last sm:mb-0 text-xs">{{
                        information.created_at }}</time>
                </div>
                <div class="font-normal text-sm sm:text-sm md:text-md text-gray-500 dark:text-white">
                    <div v-if="showContent">
                        <div v-html="information.content"></div>
                    </div>
                    <div v-else>
                        <p>{{ truncateText(information.summary, 15) }}</p>
                    </div>
                </div>
            </div>
        </li>

        <li v-else class="ml-6">
            <span
                class="flex absolute -left-4 justify-center items-center w-8 h-8 text-slate-100 font-bold bg-main rounded-full ring-white">
                i
            </span>
            <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 shadow-sm">
                <div class="mb-2 text-sm">
                    <span class="font-bold text-black dark:text-white block text-base sm:text-lg">
                        Selamat Datang
                    </span>
                    <time class="mb-1 font-normal text-gray-400 dark:text-gray-500 sm:order-last sm:mb-0 text-xs">
                        {{ currentTime }}
                    </time>
                </div>
                <div class="font-normal text-sm sm:text-sm md:text-md text-gray-500 dark:text-white">
                    <p>
                        Selamat bergabung di
                        <Link href="/" class="cursor-pointer text-blue-600 dark:text-blue-400 active:rounded-full">
                        {{ page.props.app.app_name }}.
                        </Link>
                        Jika suatu hari anda mengalami masalah saat melakukan transaksi, anda dapat
                        menghubungi kami dengan menyertakan bukti screenshot masalah anda di menu
                        Bantuan
                    </p>
                </div>
            </div>
        </li>

    </ol>
</template>