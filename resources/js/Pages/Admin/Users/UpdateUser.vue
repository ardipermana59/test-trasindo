<script setup>
import { defineProps, ref } from 'vue';
import { useForm } from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';

import EditButton from '@/Components/Buttons/Crud/EditButton.vue';
import ErrorList from '@/Components/ErrorList.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import FormGrid from '@/Components/FormGrid.vue';
import Modal from '@/Components/Modal.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import WarningButton from '@/Components/Buttons/WarningButton.vue';

const isEditModalVisible = ref(false);
const props = defineProps({
    user: Object,
});

const formEditData = useForm({
    name: '',
    email: '',
    role: '',
});

const hideModal = () => {
    isEditModalVisible.value = false;
    formEditData.reset();
};

const showEditModal = () => {
    formEditData.name = props.user.name;
    formEditData.username = props.user.username;
    formEditData.email = props.user.email;
    formEditData.phone = props.user.phone;
    formEditData.role = props.user.role;
    formEditData.status = props.user.status;
    formEditData.id = props.user.id;
    isEditModalVisible.value = true;
};

const updateUser = () => {
    const toastId = toast.loading("Memperbarui data...");

    formEditData.put(route('users.update', formEditData.id), {
        preserveScroll: true,
        onSuccess: () => {
            hideModal();
            toast.update(toastId, {
                render: "Data berhasil diperbarui!",
                type: "success",
                isLoading: false,
                autoClose: 2000,
            });
        },
        onError: () => {
            toast.update(toastId, {
                render: "Gagal memperbarui data.",
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

    <Modal :show="isEditModalVisible" @close="isEditModalVisible = false">
        <form @submit.prevent="updateUser" class="p-4 md:p-5">
            <ErrorList :errors="formEditData.errors" />
            <FormGrid>
                <div class="col-span-2">
                    <InputLabel value="Nama" required />

                    <TextInput v-model="formEditData.name" :error="formEditData.errors.name" type="text"
                        class="mt-1 block w-full dark:bg-gray-600" placeholder="Masukan Nama" required />
                    <InputError class="mt-2" :message="formEditData.errors.name" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Email" required />

                    <TextInput v-model="formEditData.email" :error="formEditData.errors.email" type="email"
                        class="mt-1 block w-full dark:bg-gray-600" placeholder="youremail@gmail.com" required />
                    <InputError class="mt-2" :message="formEditData.errors.email" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Username" />

                    <TextInput v-model="formEditData.username" :error="formEditData.errors.username" type="text"
                        class="mt-1 block w-full dark:bg-gray-600" placeholder="Masukan Username" />
                    <InputError class="mt-2" :message="formEditData.errors.username" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Phone" />

                    <TextInput v-model="formEditData.phone" :error="formEditData.errors.phone" type="text"
                        class="mt-1 block w-full dark:bg-gray-600" placeholder="Masukan Phone" />
                    <InputError class="mt-2" :message="formEditData.errors.phone" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Role" required />

                    <SelectInput v-model="formEditData.role" :error="formEditData.errors.role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="superadmin">Superadmin</option>
                        <option value="member">Member</option>
                    </SelectInput>
                    <InputError class="mt-2" :message="formEditData.errors.role" />
                </div>
                <div class="col-span-2">
                    <InputLabel value="Status" />

                    <SelectInput v-model="formEditData.status" :error="formEditData.errors.status" required>
                        <option value="">Pilih Status</option>
                        <option value="active">Aktif</option>
                        <option value="nonactive">Tidak Aktif</option>
                    </SelectInput>
                    <InputError class="mt-2" :message="formEditData.errors.status" />
                </div>
            </FormGrid>
            <WarningButton :disabled="formEditData.processing" type="submit"
                :class="{ 'opacity-25': formEditData.processing }">
                {{ formEditData.processing ? 'Loading...' : 'Update' }}
            </WarningButton>
        </form>
    </Modal>
</template>