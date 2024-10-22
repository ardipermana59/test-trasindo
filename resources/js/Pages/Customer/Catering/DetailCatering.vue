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
import WarningButton from '@/Components/Buttons/WarningButton.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import { formatCurrency } from '@/Utils/formatCurrency';

const isEditModalVisible = ref(false);
const page = usePage();
const props = defineProps({
    data: Object,
});

const type = ref(null)
const name = ref(null)
const description = ref(null)
const photo = ref(null)
const price = ref(null)
const previewPhoto = ref(null);

const formEditData = useForm({
    id: '',
    merchant_id: '',
    amount: '',
    delivery_date: ''
});

const showEditModal = () => {
    type.value = props.data.type.name;
    name.value = props.data.name;
    description.value = props.data.description;
    photo.value = props.data.photo_url;
    price.value = formatCurrency(props.data.price);

    formEditData.id = props.data.id;
    formEditData.merchant_id = props.data.merchant_id;
    previewPhoto.value = props.data.photo_url;
    isEditModalVisible.value = true;
};

const hideModal = () => {
    isEditModalVisible.value = false;
    formEditData.reset();
};

const updateData = () => {
    const toastId = toast.loading("Memperbarui data...");

    formEditData.post(route('customer.caterings.order'), {
        preserveScroll: true,
        onSuccess: () => {
            hideModal();
            isEditModalVisible.value = false;
            toast.update(toastId, {
                render: page.props.flash?.message ?? "Pesanan berhasil!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
        },
        onError: () => {
            toast.update(toastId, {
                render: page.props.flash?.message ?? "Gagal pesan.",
                type: "error",
                isLoading: false,
                autoClose: 2000,
            });
        }
    });
};

</script>
<template>
    <PrimaryButton @click="showEditModal()" type="button">Detail</PrimaryButton>

    <Modal :show="isEditModalVisible" @close="isEditModalVisible = false">
        <form @submit.prevent="updateData" class="p-4 md:p-5">
            <ErrorList :errors="formEditData.errors" />

            <FormGrid>
                <div class="col-span-2 flex justify-center items-center flex-col relative mb-5">
                    <div class="relative">
                        <div v-if="previewPhoto">
                            <img :src="previewPhoto" alt="Preview Foto Kandidat"
                                class="w-32 h-32 object-cover rounded" />
                        </div>
                        <div v-else class="w-32 h-32 flex justify-center items-center bg-gray-200 rounded">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-2">
                    <InputLabel value="Tipe Menu" />

                    <TextInput v-model="type" type="text" class="mt-1 block w-full dark:bg-gray-600" readonly
                        disabled />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Nama Menu" />

                    <TextInput v-model="name" type="text" class="mt-1 block w-full dark:bg-gray-600" readonly
                        disabled />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Deskripsi" />

                    <TextAreaInput v-model="description" rows="3" readonly disabled />

                </div>
                <div class="col-span-2">
                    <InputLabel value="Harga Satuan" />

                    <TextInput v-model="price" type="text" class="mt-1 block w-full dark:bg-gray-600" readonly
                        disabled />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Jumlah Porsi" required />

                    <TextInput v-model="formEditData.amount" :error="formEditData.errors.amount" type="text"
                        class="mt-1 block w-full dark:bg-gray-600" placeholder="Masukan Jumlah Porsi" required />
                    <InputError class="mt-2" :message="formEditData.errors.amount" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Tanggal Pengiriman" required />

                    <TextInput v-model="formEditData.delivery_date" :error="formEditData.errors.delivery_date"
                        type="date" class="mt-1 block w-full dark:bg-gray-600" placeholder="Masukan Tanggal Pengiriman"
                        required />
                    <InputError class="mt-2" :message="formEditData.errors.delivery_date" />
                </div>
            </FormGrid>
            <WarningButton :disabled="formEditData.processing" type="submit"
                :class="{ 'opacity-25': formEditData.processing }">
                {{ formEditData.processing ? 'Loading...' : 'Pesan' }}
            </WarningButton>
        </form>
    </Modal>
</template>