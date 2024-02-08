<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    event: {
        type: Array,
        required: true,
    },
    userId: {
        type: Number,
        required: true,
    },
    userName: {
        type: String,
        required: true,
    },
    locations: {
        type: Array,
        required: true,
    },
    isUserAttached: {
        type: Boolean,
        required: true,
    },
    userCount: {
        type: Number,
        required: true,
    },
    attachedCategories: {
        type: Array,
        required: true,
    },
    relatedEvents: {
        type: Array,
        required: true,
    },
});


</script>

<template>
    <AppLayout title="Events">

        <section class="px-8 py-12">

            <div class="container mx-auto flex flex-wrap pb-12">

                <header class="w-full text-left pb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Evenements</h2>
                    <p class="mt-4 text-6xl font-bold">
                        {{ event.title }}
                    </p>
                </header>

                <div class="w-full md:w-1/2 p-6 flex flex-col">
                    <img src="https://picsum.photos/1000?random=0" alt=""
                        class="mx-auto w-96 h-96 object-cover rounded-lg shadow-md" />
                </div>

                <div class="w-full md:w-1/2 p-6 space-y-2">
                    <span
                        class="inline-block bg-red-200 text-red-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">
                        {{ event.location }}
                    </span>
                    <p class="mt-1 text-lg leading-tight font-semibold text-gray-900">
                        {{ event.description }}
                    </p>
                    <p class="mt-2 text-gray-600">
                        Price: {{ event.price }}$
                    </p>
                    <p class="mt-2 text-gray-600">
                        Capacity: {{ event.capacity }} places
                    </p>
                    <p class="mt-2 text-gray-600">
                        Starts at: {{ event.start_date }}
                    </p>
                    <p class="mt-2 text-gray-600">
                        Ends at: {{ event.end_date }}
                    </p>
                    <p class="mt-2 text-gray-600">
                        Participants : {{ props.userCount }}
                    </p>
                    <a v-if="!props.isUserAttached" :href="`/attach/events/${props.event.id}/users/${props.userId}`" class="mt-4 block w-full px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-gray-700 rounded shadow
                    hover:shadow-lg hover:bg-gray-600 focus:outline-none">
                        S'inscrire
                    </a>
                    <a v-else :href="`/detach/events/${props.event.id}/users/${props.userId}`" class="mt-4 block w-full px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-red-600 rounded shadow
                    hover:shadow-lg hover:bg-red-500 focus:outline-none">
                        Se désinscrire
                    </a>
                </div>

                <div class="block">
                    <div>
                        <ul>
                            Liste des participants :
                            <li v-for="p in props.userCount"> {{ props.userName.name }}</li>
                        </ul>
                    </div>
                    <div>
                        Catégorie :
                        <div v-if="props.attachedCategories && props.attachedCategories.length > 0">
                            <p v-for="category in props.attachedCategories"> {{ category.name }}
                            </p>
                        </div>
                        <p v-else> pas de catégorie attachée </p>
                    </div>


                    <h2>Événements avec une ou plusieurs catégorie.s commune.s :</h2>

                    <div v-if="props.relatedEvents && props.relatedEvents.length > 0">

                        <ul class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <li v-for="(relatedEvent, index) in props.relatedEvents.slice(0, 4)" :key="index">
                                <a :href="route('events.show', relatedEvent)" class="block overflow-hidden">
                                    <div class="group">
                                        <img src="https://picsum.photos/1000?random=0" alt=""
                                            class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]" />
                                        <h3
                                            class="mt-2 text-sm text-gray-700 group-hover:underline group-hover:underline-offset-4">
                                            {{ relatedEvent.title }}
                                        </h3>
                                    </div>
                                    <div class="relative bg-white pt-3">
                                        <p>
                                            <span class="tracking-wider text-gray-900"> {{ relatedEvent.price }}$</span>
                                        </p>
                                        <p>
                                            <span
                                                class="tracking-wider text-red-800 text-xs hover:underline hover:underline-offset-4">
                                                {{ relatedEvent.location }} {{ relatedEvent.attachedCategories }}
                                            </span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <p v-else> Aucun événement avec la même catégorie trouvé </p>





                    <h2>Événements dans la même ville :</h2>

                    <div v-if="props.locations && props.locations.length > 0">

                        <ul class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <li v-for="location in locations">
                                <div v-if="location.title == event.title"></div>
                                <div v-else>
                                    <a :href="route('events.show', location)" class="block overflow-hidden">

                                        <div class="group">
                                            <img src="https://picsum.photos/1000?random=0" alt=""
                                                class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]" />
                                            <h3
                                                class="mt-2 text-sm text-gray-700 group-hover:underline group-hover:underline-offset-4">
                                                {{ location.title }}
                                            </h3>
                                        </div>
                                        <div class="relative bg-white pt-3">
                                            <p>
                                                <span class="tracking-wider text-gray-900"> {{ location.price }}$</span>
                                            </p>
                                            <p>
                                                <span
                                                    class="tracking-wider text-red-800 text-xs hover:underline hover:underline-offset-4">
                                                    {{ location.location }} {{ location.attachedCategories }}
                                                </span>
                                            </p>
                                        </div>
                                    </a>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <p v-else> Aucun événement avec la même ville trouvé </p>
                </div>

            </div>


        </section>

    </AppLayout>
</template>

<style scoped></style>
