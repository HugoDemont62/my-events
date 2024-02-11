<template>
    <AppLayout title="Create Event">
        <section class="px-8 py-12">
            <form method="POST" action="/events">
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="title">
                        Title
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="title"
                           id="title"
                           required
                    >

                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="description">
                        Description
                    </label>

                    <textarea class="border border-gray-400 p-2 w-full"
                              name="description"
                              id="description"
                              required
                    ></textarea>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="location">
                        Location
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="location"
                           id="location"
                           required
                    >
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="price">
                        Price
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="price"
                           id="price"
                           required
                    >

                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="start_date">
                        Start Date
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="date"
                           name="start_date"
                           id="start_date"
                           required
                    >
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="end_date">
                        End Date
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="date"
                           name="end_date"
                           id="end_date"
                           required
                    >

                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="image">
                        Image
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="file"
                           name="image"
                           id="image"
                           required
                    >

                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                        Create
                    </button>
                </div>
            </form>
        </section>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout
    }
}
</script>

<style scoped></style>
