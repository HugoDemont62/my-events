<template>
    <AppLayout>
        <div>
            <h1>{{ props.category.name }}</h1>
            <ul>
                <li v-for="(event, index) in props.events" :key="index">
                    <a :href="route('events.show', event)" class="block overflow-hidden">
                        <div class="event">
                            <img src="https://picsum.photos/1000?random=0" alt=""
                                 class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]"/>
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
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
    events: {
        type: Array,
        required: true,
    },
});
</script>
