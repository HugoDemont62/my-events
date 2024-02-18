<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,

    events: {
        type: Array,
        required: true,
    },
    popularCategories: {
        type: Array,
        required: true,
    },
});

console.log(props.events);
</script>


<template>
    <AppLayout title="Events">
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
                <!-- link to create event -->
                <Link :href="route('events.create')"
                      class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Event
                </Link>
            </div>
        </div>
        <section class="px-8 py-12">
            <div id="events-list">
                <ul class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <li v-for="(event, index) in props.events">
                        <a :href="route('events.show', event)" class="block overflow-hidden">

                            <div class="event">
                                <img src="https://picsum.photos/1000?random=0" alt=""
                                     class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]"/>
                                <h3 class="mt-2 text-sm text-gray-700 group-hover:underline group-hover:underline-offset-4">
                                    {{ event.title }}
                                </h3>
                            </div>
                            <div class="relative bg-white pt-3">
                                <p>
                                    <span class="tracking-wider text-gray-900"> {{ event.price }}$</span>
                                </p>
                                <p>
                                    <span
                                        class="tracking-wider text-red-800 text-xs hover:underline hover:underline-offset-4">
                                        {{ event.location }} </span>
                                    <span class="tracking-wider text-xs hover:underline hover:underline-offset-4">
                                        {{ event.start_date }} </span>
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="popular-categories">
                <h2 class=" mb-6 text-xl font-extrabold text-gray-900">Popular Categories</h2>
                <ul class="flex space-x-12">
                    <li v-for="(category, index) in props.popularCategories" :key="index">
                        <a :href="route('categories.show', category)" class="block overflow-hidden">
                            <img :src="`https://picsum.photos/1000?random=0`" :alt="category.name"
                            class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]" />
                            <p>{{ category.name }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </section>


    </AppLayout>
</template>

<style scoped></style>