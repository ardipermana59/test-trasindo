<script setup>
import WarningButton from '@/Components/Buttons/WarningButton.vue';
import { defineProps } from 'vue';
import axios from 'axios';

const props = defineProps({
    id: Number,
});

const downloadInvoice = async (id) => {
    try {
        const response = await axios.get(route('merchant.orders.invoice', id), {
            responseType: 'blob' 
        });

        const blob = new Blob([response.data], { type: 'application/pdf' });
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = `invoice-${id}.pdf`; 
        link.click();
    } catch (error) {
        console.error('Failed to download invoice:', error);
    }
};

</script>
<template>
    <WarningButton @click="downloadInvoice(id)" >Invoice</WarningButton>
</template>