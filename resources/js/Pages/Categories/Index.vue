<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});
</script>


<template>
    <AppLayout>
        <div>
            <h1 class="m-6 text-xl font-extrabold text-gray-900">Categories</h1>
            <ul class="grid grid-cols-4 gap-4 m-4">
                <li v-for="(category, index) in props.categories" :key="index">
                    <a :href="route('categories.show', category)" class="block overflow-hidden">
                        <img :src="`https://picsum.photos/1000?random=0`" :alt="category.name"
                            class="h-[200px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[200px]" />
                        <p>{{ category.name }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
