<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import EditStudent from '../Student/EditStudent.vue';
import EditTeacher from '../Teacher/EditTeacher.vue';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    role: Object,
    cycles: Object
});
</script>

<template>
    <Head title="Profile" />
    <MainLayout :simple="true">

        <div class="py-12 mt-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="md:flex justify-center gap-16">
                    <div class="m-8 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>

                    <div class="m-8 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>
                </div>
                
                
                <EditStudent :cycles="cycles" :student="role" v-if="$page.props.auth.user.roleable_type== 'App\\Models\\Student'"></EditStudent>
                <EditTeacher :teacher="role" v-else-if="$page.props.auth.user.roleable_type== 'App\\Models\\Teacher'"></EditTeacher>

                

                <!-- <div class="m-8 p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                v-if="$page.props.auth.user.roleable_type== 'App\\Models\\Student' || $page.props.auth.user.roleable_type== 'App\\Models\\Teacher'"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div> -->
            </div>
        </div>
    </MainLayout>
</template>
