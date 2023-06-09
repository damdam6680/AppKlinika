<template>
    <navbar></navbar>
    <sidebar></sidebar>

    <div class="p-4 sm:ml-64 max-w-screen-2xl">
        <div class="mb-6 text-red-500">
            <div id="error-message" class="text-red-500"></div>
        </div>
        <div v-if="dentist">
            <form class="p-10" @submit.prevent="updateUser">
                <div class="mb-6">
                    <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                    <input type="text" id="firstName" v-model="dentist.first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                    <input type="text" id="lastName" v-model="dentist.last_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="specialization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Specialization</label>
                    <input type="text" id="specialization" v-model="dentist.specialization"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                    <input type="text" id="phoneNumber" v-model="dentist.phone_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
        <div v-else>
            Loading...
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import navbar from '../navbar.vue'
import sidebar from './DentsiSidebar.vue'

// User object
const dentist = ref(null);

// Method to update user
const updateUser = async () => {
    try {
        const token = localStorage.getItem('token');

        // Prepare the data for the PATCH request
        const data = {
            first_name: dentist.value.first_name,
            last_name: dentist.value.last_name,
            specialization: dentist.value.specialization,
            phone_number: dentist.value.phone_number
        };

        const response = await axios.put('http://127.0.0.1:8000/api/dentists/me', data, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });

        if (response.status === 200) {
            document.getElementById('error-message').textContent = '';
        }
        // Handle the response
        console.log(response.data); // Modify this to handle the response as needed
    } catch (error) {
        // Handle errors
        console.error(error);

        if (error.response && error.response.status !== 200) {
            const errorMessage = error.response.data.message;
            // Wyświetl komunikat błędu nad formularzem
            document.getElementById('error-message').textContent = errorMessage;
        }
    }
};

// Fetch dentist data on component mount
onMounted(async () => {
    try {
        const token = localStorage.getItem('token');
        const response = await axios.get('http://127.0.0.1:8000/api/dentists/me', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });

        if (response.status === 200) {
            dentist.value = response.data;
        }
    } catch (error) {
        console.error(error);
    }
});
</script>
