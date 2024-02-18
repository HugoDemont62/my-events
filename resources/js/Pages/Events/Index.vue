<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';

const sortSelect = defineModel("null");
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

let date = props.events["start_date"];
console.log(date);
console.log(document.getElementById('sortBy'));

const filtrer = () => {
    window.location.href = route('events.index')+ '?sort=' + sortSelect.value;
};
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
                    <div class="hidden sm:block">
                        <label for="sortBy" class="sr-only">SortBy</label>
                        <select @change="filtrer" v-model="sortSelect" id="sort-select" class="h-10 rounded border-gray-300 text-sm">
                            <option value="null">Trier par</option>
                            <option value="startdate" id="startdate">Par date de début</option>
                            <option value="minprice" id="minprice">Par prix ascendant</option>
                            <option value="maxprice" id="maxprice">Par prix descendant</option>
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
