<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';


const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});
console.log(props.events.data);

let date = props.events["start_date"];
console.log(date);
//const sorted = events.data.sortBy('start_date');
//sorted.all();
// {{ event.start_date }}
</script>

<script>

// function sortByStartDate() {
//     props.events.data.sort((a, b) => new Date(a.start_date) - new Date(b.start_date));
// }
// document.getElementById('sort-select').addEventListener('change', sortByStartDate);

</script>

<template>
    <AppLayout title="Events">
        <section>
            <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                <header>
                    <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Evenements</h2>

                    <p class="mt-4 max-w-md text-gray-500">
                        Bienvenue sur notre super site d'événements!
                    </p>
                </header>
                <div class="mt-8 sm:flex sm:items-center sm:justify-between">
                    <div class="block sm:hidden">
                        <button
                            class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600">
                            <span class="text-sm font-medium"> Filters & Sorting </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-4 w-4 rtl:rotate-180">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden sm:block">
                        <label for="SortBy" class="sr-only">SortBy</label>
                        <select id="sort-select" class="h-10 rounded border-gray-300 text-sm">
                            <option>Trier par</option>
                            <option value="startdate" id="startdate">Par date de début</option>
                        </select>
                    </div>
                </div>
                <div id="events-list">
                    <ul class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <li v-for="(event, index) in events.data">
                            <a :href="route('events.show', event)" class="block overflow-hidden">
                                <div class="event">
                                    <img src="https://picsum.photos/1000?random=0" alt=""
                                        class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]" />
                                    <h3
                                        class="mt-2 text-sm text-gray-700 group-hover:underline group-hover:underline-offset-4">
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


                <Pagination :links="events.links" />
            </div>
        </section>
    </AppLayout>
</template>
<style scoped></style>
