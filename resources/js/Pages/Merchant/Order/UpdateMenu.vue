<script setup>
import { defineProps, ref } from 'vue';
import { useForm, usePage } from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';

import ErrorList from '@/Components/ErrorList.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import FormGrid from '@/Components/FormGrid.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/Buttons/WarningButton.vue';
import EditButton from '@/Components/Buttons/Crud/EditButton.vue';

const isModalVisible = ref(false);

const page = usePage();

const customer = ref();
const menu = ref();
const amount = ref();
const delivery_date = ref();

const props = defineProps({
    order: Object,
});

const form = useForm({
    status: '',
    id: ''
});

const showEditModal = () => {

    customer.value = props.order.customer.company_name;
    menu.value = props.order.menu.name;
    amount.value = props.order.quantity;
    delivery_date.value = props.order.delivery_date;
    form.status = props.order.status;
    form.id = props.order.id;
    isModalVisible.value = true;
};

const hideModal = () => {
    isModalVisible.value = false;
    form.reset();
};

const updateData = () => {
    const toastId = toast.loading("Memperbarui data...");

    form.put(route('merchant.orders.update', { id: form.id }), {
        preserveScroll: true,
        onSuccess: () => {
            hideModal();
            isModalVisible.value = false;
            toast.update(toastId, {
                render: page.props.flash?.message ?? "Data berhasil diperbarui!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
        },
        onError: () => {
            toast.update(toastId, {
                render: page.props.flash?.message ?? "Gagal memperbarui data.",
                type: "error",
                isLoading: false,
                autoClose: 2000,
            });
        }
    });
};
</script>
<template>
    <EditButton @click="showEditModal()" type="button" />

    <Modal :show="isModalVisible" @close="isModalVisible = false">
        <form @submit.prevent="updateData" class="p-4 md:p-5" enctype="multipart/form-data">
            <ErrorList :errors="form.errors" />

            <FormGrid enctype="multipart/form-data">
                <div class="col-span-2">
                    <InputLabel value="Customer" />

                    <TextInput v-model="customer" type="text" class="mt-1 block w-full dark:bg-gray-600" disabled
                        readonly />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Menu" />

                    <TextInput v-model="menu" type="text" class="mt-1 block w-full dark:bg-gray-600" disabled
                        readonly />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Jumlah Pesanan" />

                    <TextInput v-model="amount" type="text" class="mt-1 block w-full dark:bg-gray-600" disabled
                        readonly />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Tanggal" />

                    <TextInput v-model="delivery_date" type="date" class="mt-1 block w-full dark:bg-gray-600" disabled
                        readonly />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Status" required />

                    <SelectInput v-model="form.status" :error="form.errors.type_id" required>
                        <option value="">Pilih Status</option>
                        <option value="pending">Pending</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </SelectInput>
                    <InputError class="mt-2" :message="form.errors.status" />
                </div>
            </FormGrid>
            <WarningButton :disabled="form.processing" type="submit" :class="{ 'opacity-25': form.processing }">
                {{ form.processing ? 'Loading...' : 'Update' }} 
            </WarningButton>
        </form>
    </Modal>
</template>
