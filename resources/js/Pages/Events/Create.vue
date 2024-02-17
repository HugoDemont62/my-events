<template>
    <AppLayout title="Create Event">
        <section class="px-8 py-12 flex">
            <!-- Form Section -->
            <div class="w-1/2">
                <form action="/events" method="post" enctype="multipart/form-data" class="space-y-4">
                    <input type="text" name="title" placeholder="Title" required class="w-full p-2 border border-gray-300 rounded">
                    <textarea name="description" placeholder="Description" required class="w-full p-2 border border-gray-300 rounded"></textarea>
                    <input type="text" name="location" placeholder="Location" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="number" step="0.01" name="price" placeholder="Price" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="number" name="capacity" placeholder="Capacity" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="date" name="start_date" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="date" name="end_date" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="file" name="image" required class="w-full p-2 border border-gray-300 rounded">
                    <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">Submit</button>
                </form>
            </div>
            <div class="w-1/2">
            </div>
        </section>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {AppLayout},
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
};
</script>

<style scoped></style>
