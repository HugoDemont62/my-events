<template>
    <AppLayout>
        <div>
            <h1>Categories</h1>
            <ul>
                <li v-for="(category, index) in props.categories" :key="index">
                    <a :href="route('categories.show', category)" class="block overflow-hidden">
                        <img :src="`https://via.placeholder.com/150?text=${category.name}`" :alt="category.name"/>
                        <p>{{ category.name }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>

<script setup>
import {defineProps} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});
</script>
