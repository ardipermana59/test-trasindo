<script setup>
import { defineProps, ref, watch } from 'vue';
import { useForm, usePage } from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';
import { component as VueNumberFormat } from '@coders-tm/vue-number-format';

import AddButton from '@/Components/Buttons/Crud/AddButton.vue';
import ErrorList from '@/Components/ErrorList.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import FormGrid from '@/Components/FormGrid.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';

const page = usePage();
const props = defineProps({
    types: Object,
});

const previewPhoto = ref(null);
const isAddModalVisible = ref(false);

const formAddData = useForm({
    type_id: '',
    name: '',
    description: '',
    photo: '',
    price: ''
});

const hideModal = () => {
    isAddModalVisible.value = false;
    formAddData.reset();
};

const addData = () => {
    const toastId = toast.loading("Menambahkan data...");
    formAddData.post(route('merchant.menus.store'), {
        preserveScroll: true,
        onSuccess: () => {
            hideModal();
            toast.update(toastId, {
                render: page.props.flash?.message ?? "Data berhasil ditambahkan!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
            formAddData.reset();
        },
        onError: () => {
            toast.update(toastId, {
                render: page.props.flash?.message ?? "Gagal menambahkan data.",
                type: "error",
                isLoading: false,
                autoClose: 2000,
            });
        }
    });
};

const numberOptions = ref({
    decimal: ',',
    separator: '.',
    prefix: 'Rp. ',
    precision: 0,
    masked: false,
    suffix: "",
    nullValue: "0",
    reverseFill: false,
    min: 0,
    max: 10000000
});

const triggerFileInput = () => {
    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput) {
        fileInput.click();
    }
};
const handleFileChange = (event) => {
    const file = event.target.files[0];

    const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    const maxSizeInMB = 2;
    const maxSizeInBytes = maxSizeInMB * 1024 * 1024; // 2 MB dalam bytes

    if (file) {
        if (!validImageTypes.includes(file.type)) {
            toast.error("File yang diunggah harus berupa gambar (jpg, png, atau gif).");
            formAddData.photo = null;
            previewPhoto.value = null;
            return;
        }

        if (file.size > maxSizeInBytes) {
            toast.error(`File tidak boleh lebih dari ${maxSizeInMB} MB.`);
            formAddData.photo = null;
            previewPhoto.value = null;
            return;
        }

        formAddData.photo = file;

        const reader = new FileReader();
        reader.onload = (e) => {
            previewPhoto.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        previewPhoto.value = null;
    }
};
</script>

<template>
    <AddButton @click="isAddModalVisible = true" type="button">
        Tambah Menu
    </AddButton>

    <Modal :show="isAddModalVisible" @close="isAddModalVisible = false">
        <form @submit.prevent="addData" class="p-4 md:p-5" enctype="multipart/form-data">
            <ErrorList :errors="formAddData.errors" />

            <FormGrid enctype="multipart/form-data">
                <div class="col-span-2 flex justify-center items-center flex-col relative mb-5">
                    <div class="relative cursor-pointer" @click="triggerFileInput">
                        <div v-if="previewPhoto">
                            <img :src="previewPhoto" alt="Preview Foto Kandidat"
                                class="w-32 h-32 object-cover rounded" />
                        </div>
                        <div v-else class="w-32 h-32 flex justify-center items-center bg-gray-200 rounded">
                            <span class="text-gray-500">No Image</span>
                        </div>

                        <button type="button"
                            class="absolute bottom-2 right-2 p-2 bg-blue-500 text-white rounded-full focus:outline-none">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <input type="file" ref="fileInputRef" class="hidden" @change="handleFileChange" />
                </div>

                <div class="col-span-2">
                    <InputLabel value="Tipe Menu" required />

                    <SelectInput v-model="formAddData.type_id" :error="formAddData.errors.type_id" required>
                        <option value="">Pilih Tipe</option>
                        <option v-for="type in types" :key="type.id" :value="type.id">
                            {{ type.name }}
                        </option>
                    </SelectInput>
                    <InputError class="mt-2" :message="formAddData.errors.type_id" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Nama Menu" required />

                    <TextInput v-model="formAddData.name" :error="formAddData.errors.name" type="text"
                        class="mt-1 block w-full dark:bg-gray-600" placeholder="Masukan Nama Menu" required />
                    <InputError class="mt-2" :message="formAddData.errors.name" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Deskripsi" required />

                    <TextAreaInput v-model="formAddData.description" rows="3" :error="formAddData.errors.description"
                        placeholder="Masukan Deskripsi" required />

                    <InputError class="mt-2" :message="formAddData.errors.description" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Harga Satuan" required />

                    <VueNumberFormat
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        v-model="formAddData.price" v-bind="numberOptions" required />
                    <InputError class="mt-2" :message="formAddData.errors.description" />
                </div>

            </FormGrid>
            <PrimaryButton :disabled="formAddData.processing" type="submit"
                :class="{ 'opacity-25': formAddData.processing }">

                {{ formAddData.processing ? 'Loading...' : 'Tambah' }}
            </PrimaryButton>
        </form>
    </Modal>
</template>