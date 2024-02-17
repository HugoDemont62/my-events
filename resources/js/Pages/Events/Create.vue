<template>
    <AppLayout title="Create Event">
        <section class="px-8 py-12">
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <input type="text" v-model="form.title" placeholder="Title" required>
                <textarea v-model="form.description" placeholder="Description" required></textarea>
                <input type="text" v-model="form.location" placeholder="Location" required>
                <input type="number" step="0.01" v-model="form.price" placeholder="Price" required>
                <input type="date" v-model="form.start_date" required>
                <input type="date" v-model="form.end_date" required>
                <input type="file" @change="handleImageUpload" required>
                <button type="submit">Submit</button>
            </form>
        </section>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {AppLayout},
    data: function () {
        return {
            form: {
                title: '',
                description: '',
                location: '',
                price: '',
                start_date: '',
                end_date: '',
                image: null,
            }
        }
    },
    methods: {
        submitForm: function () {
            let formData = new FormData();

            Object.keys(this.form).forEach(key => {
                formData.append(key, this.form[key]);
            });

            axios.post('/events', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
        },
        handleImageUpload(event) {
            this.form.image = event.target.files[0];
        },
    }
}
</script>

<style scoped></style>
