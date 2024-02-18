<template>
    <AppLayout title="Create Event">
        <section class="px-8 py-12 flex">
            <!-- Form Section -->
            <div class="w-1/2">
                <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-4">
                    <input type="text" v-model="formData.title" placeholder="Title" required class="w-full p-2 border border-gray-300 rounded">
                    <textarea v-model="formData.description" placeholder="Description" required class="w-full p-2 border border-gray-300 rounded"></textarea>
                    <input type="text" v-model="formData.location" placeholder="Location" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="number" step="1" v-model="formData.price" min="1" placeholder="Price" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="number" v-model="formData.capacity" placeholder="Capacity" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="date" v-model="formData.start_date" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="date" v-model="formData.end_date" required class="w-full p-2 border border-gray-300 rounded">
                    <input type="file" ref="image" required class="w-full p-2 border border-gray-300 rounded">
                    <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">Submit</button>
                </form>
            </div>
        </section>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';

export default {
    components: { AppLayout },
    data() {
        return {
            formData: {
                title: '',
                description: '',
                location: '',
                price: '',
                capacity: '',
                start_date: '',
                end_date: '',
            }
        };
    },
    methods: {
        submitForm() {
            let formData = new FormData();
            for (let key in this.formData) {
                formData.append(key, this.formData[key]);
            }
            formData.append('image', this.$refs.image.files[0]);

            axios.post('/events', formData)
                .then(response => {
                    console.log('Event created successfully');
                    console.log(formData);
                    // Rediriger vers la page d'index des événements ou toute autre action nécessaire
                    this.$inertia.visit('/events');
                })
                .catch(error => {
                    console.error('Error creating event: ', error);
                    // Gérer les erreurs, par exemple, afficher des messages à l'utilisateur
                });
        }
    }
};
</script>

<style scoped></style>
