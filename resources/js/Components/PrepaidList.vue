<script setup>
import { defineProps } from 'vue';
import { formatCurrency } from '@/Utils/formatCurrency';
import MainCard from './MainCard.vue';

const props = defineProps({
    prepaids: {
        type: Array,
        required: true
    },
    loading: Boolean,
    onClick: {
        type: Function,
        required: true
    }
});

</script>
<template>
    <MainCard v-if="loading" v-for="i in 7" class="flex relative animate-pulse mb-2" style="padding: 0;">
        <div class="w-1/5 py-4 pl-4">
            <div class="h-3 bg-slate-700 rounded mb-3"></div>
            <div class="h-3 bg-slate-700 rounded"></div>
        </div>
        <div class="w-3/5"></div>
        <div class="w-1/5 align-middle inline-block  m-auto pr-4">
            <div class="h-3 bg-slate-700 rounded"></div>
        </div>
    </MainCard>
    <div v-else>
        <ul v-if="prepaids.length > 0">
            <li v-for="prepaid in prepaids" :key="prepaid.code">
                <MainCard @click="props.onClick(prepaid)"
                    class="shadow-md text-base flex relative mb-2 cursor-pointer bg-white" style="padding: 0;">
                    <div class="w-5/6 py-4 pl-4">
                        <p class="font-semibold">{{ prepaid.product_name }} <span
                                v-if="!prepaid.is_active || !prepaid.buyer_product_status || !prepaid.seller_product_status"
                                class="text-white px-4 bg-red-500 rounded-bl-lg rounded-tr-md">Tidak aktif</span>
                        </p>
                        <p class="text-gray-500 text-md">{{ prepaid.desc }}</p>
                    </div>
                    <div class="w-2/6 align-middle inline-block m-auto pr-4">
                        <div class="font-semibold m-auto text-center">
                            {{ formatCurrency(prepaid.selling_price) }}
                        </div>

                    </div>
                    <div v-if="prepaid.code.includes('PROMO')"
                        class="text-white px-4 bg-sky-500 rounded-bl-lg rounded-tr-md absolute top-0 right-0 sm:px-4">
                        Promo
                    </div>
                    <div v-else-if="prepaid.discount > 0"
                        class="text-white px-4 bg-red-600 rounded-bl-lg rounded-tr-md absolute top-0 right-0 sm:px-4">
                        Disc {{ formatCurrency(prepaid.discount) }}
                    </div>
                </MainCard>
            </li>
        </ul>

        <div v-else>
            <MainCard class="text-center text-base">
                <p>Tidak ada data</p>
            </MainCard>
        </div>
    </div>
</template>