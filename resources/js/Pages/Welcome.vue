<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>


<template>
    <AppLayout>
        <Head>
            <title>Welcome</title>
        </Head>

        <div v-if="!$page.props.auth.user" class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10">
            <Link v-if="canLogin" :href="route('login')"
                  class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in
            </Link>

            <Link v-if="canRegister" :href="route('register')"
                  class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register
            </Link>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Welcome to Laravel
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Select a route from the sidebar
                </p>
            </div>
        </div>
    </AppLayout>
</template>
