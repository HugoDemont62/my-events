<script setup>
import {ref} from 'vue';
import axios from 'axios';
import AppLayout from '@/Layouts/AppLayout.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    event: {
        type: Array,
        required: true,
    },
    userId: {
        type: Number,
        required: true,
    },
    participants: {
        type: Array,
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
    isAuthenticated: {
        type: Boolean,
        required: true,
    },
    reviews: {
        type: Array,
        required: true,
    },
});

let newReview = ref({
    titleReview: '',
    content: '',
    grade: null,
});

let submitReview = async () => {
    try {
        await axios.post('/reviews', {
            titleReview: newReview.value.titleReview,
            content: newReview.value.content,
            grade: newReview.value.grade,
            event_id: props.event.id,
        });
        newReview.value = {
            titleReview: '',
            content: '',
            grade: null,
        };
        Swal.fire(
            'Avis ajouté',
            'Votre avis a bien été pris en compte',
            'success',
        );
    } catch (error) {
        console.error(error);
        Swal.fire(
            'Erreur',
            'Une erreur est survenue lors de l\'ajout de votre avis',
            'error',
        );
    }
};

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
                         class="mx-auto w-96 h-96 object-cover rounded-lg shadow-md"/>
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
                        Capacity: {{ props.userCount }} / {{ event.capacity }} places
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

                    <div v-if="props.isAuthenticated">
                        <a v-if="!props.isUserAttached" :href="`/attach/events/${props.event.id}/users/${props.userId}`"
                           class="mt-4 block w-full px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-gray-700 rounded shadow
        hover:shadow-lg hover:bg-gray-600 focus:outline-none">
                            S'inscrire
                        </a>
                        <a v-else :href="`/detach/events/${props.event.id}/users/${props.userId}`" class="mt-4 block w-full px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-red-600 rounded shadow
        hover:shadow-lg hover:bg-red-500 focus:outline-none">
                            Se désinscrire
                        </a>
                    </div>
                    <div v-else>
                        <a href="/login"
                           class="mt-4 block w-full px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-600 rounded shadow hover:shadow-lg hover:bg-blue-500 focus:outline-none">
                            Se connecter
                        </a>
                    </div>
                </div>
                <div class="reviews-section flex">
                    <!-- Section des avis -->
                    <div class="w-full">
                        <h2 class="text-2xl font-bold mb-4">Avis</h2>

                        <!-- Afficher les avis existants -->
                        <div v-if="props.reviews.length">
                            <div v-for="review in props.reviews" :key="review.id" class="mb-4">
                                <h3 class="text-xl font-semibold">{{ review.titleReview }}</h3>
                                <p class="mt-2">{{ review.content }}</p>
                                <p class="mt-2 text-sm text-gray-500">Note: {{ review.grade }}</p>
                                <!-- get the user name with the user_id -->
                                <p class="mt-2 text-sm text-gray-500">Auteur: {{ review.user_id }}</p>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-gray-500">Aucun avis pour le moment</p>
                        </div>
                    </div>

                    <!-- Formulaire pour poster un nouvel avis -->
                    <div v-if="props.isUserAttached" class="w-full ml-8">
                        <h2 class="text-2xl font-bold mb-4">Poster un avis</h2>
                        <form @submit.prevent="submitReview" class="space-y-4">
                            <div>
                                <label for="reviewTitle" class="block text-sm font-medium text-gray-700">Titre:</label>
                                <input id="reviewTitle" v-model="newReview.titleReview" type="text" required
                                       class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="reviewContent"
                                       class="block text-sm font-medium text-gray-700">Contenu:</label>
                                <textarea id="reviewContent" v-model="newReview.content" required
                                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            </div>

                            <div>
                                <label for="reviewGrade" class="block text-sm font-medium text-gray-700">Note:</label>
                                <input id="reviewGrade" v-model="newReview.grade" type="number" required
                                       class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Poster
                            </button>
                        </form>
                    </div>
                </div>

                <div class="block mt-8">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold mb-2">Liste des participants :</h2>
                        <ul class="list-disc pl-5">
                            <li v-for="participant in props.participants" :key="participant.id">
                                {{ participant.name }}
                            </li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold mb-2">Catégorie :</h2>
                        <div v-if="props.attachedCategories && props.attachedCategories.length > 0">
                            <p v-for="category in props.attachedCategories" class="mb-1"> {{ category.name }}
                            </p>
                        </div>
                        <p v-else class="text-gray-500">Pas de catégorie attachée</p>
                    </div>

                    <h2 class="text-2xl font-bold mb-2">Événements avec une ou plusieurs catégorie.s commune.s :</h2>

                    <div v-if="props.relatedEvents && props.relatedEvents.length > 0">
                        <ul class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <li v-for="(relatedEvent, index) in props.relatedEvents.slice(0, 4)" :key="index"
                                class="border p-4 rounded shadow">
                                <a :href="route('events.show', relatedEvent)" class="block overflow-hidden">
                                    <div class="group">
                                        <img src="https://picsum.photos/1000?random=0" alt=""
                                             class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]"/>
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
                    <p v-else class="text-gray-500">Aucun événement avec la même catégorie trouvé</p>
                    <h2 class="text-2xl font-bold mb-2">Événements dans la même ville :</h2>
                    <div v-if="props.locations">
                        <ul class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <li v-for="location in locations.slice(0, 4)" class="border p-4 rounded shadow">
                                <div v-if="location.title !== event.title">
                                    <a :href="route('events.show', location)" class="block overflow-hidden">
                                        <div class="group">
                                            <img src="https://picsum.photos/1000?random=0" alt=""
                                                 class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]"/>
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
                    <p v-else class="text-gray-500">Aucun événement avec la même ville trouvé</p>
                </div>

            </div>


        </section>

    </AppLayout>
</template>

<style scoped></style>
