<template>
    <div>
        <h1>{{ props.category.name }}</h1>
        <ul>
            <li v-for="(event, index) in props.events" :key="index">
                {{ event.title }}
            </li>
        </ul>
    </div>
</template>

<script setup>
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
