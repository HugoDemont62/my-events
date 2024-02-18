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
            <ul class="flex flex-wrap gap-4 space-x-4 m-6">
                <li v-for="(category, index) in props.categories" :key="index">
                    <a :href="route('categories.show', category)" class="block overflow-hidden">
                        <img :src="`https://picsum.photos/1000?random=0`" :alt="category.name"
                            class="h-[100px] w-full object-cover transition duration-500 group-hover:scale-105" />
                        <p>{{ category.name }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
