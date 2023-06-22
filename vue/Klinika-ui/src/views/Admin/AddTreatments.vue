<template>
    <Sidebar></Sidebar>
    <div class="p-4 sm:ml-64 max-w-screen-2xl">
      <!-- <div class="mb-6 text-red-500">
        <div id="error-message" class="text-red-500"></div>
      </div> -->
      <form class="p-10" @submit.prevent="addTreatment">
        <div class="mb-6">
          <label for="treatmentName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Treatment Name</label>
          <input type="text" id="treatmentName" v-model="treatment.treatment_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          <div v-if="errors.treatment_name" class="text-red-500">{{ errors.treatment_name }}</div>
        </div>
        <div class="mb-6">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
          <textarea id="description" v-model="treatment.description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
          <div v-if="errors.description" class="text-red-500">{{ errors.description }}</div>
        </div>
        <div class="mb-6">
          <label for="waitingTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waiting Time</label>
          <input type="text" id="waitingTime" v-model="treatment.waiting_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          <div v-if="errors.waiting_time" class="text-red-500">{{ errors.waiting_time }}</div>
        </div>
        <div class="mb-6">
          <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
          <input type="text" id="price" v-model="treatment.price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          <div v-if="errors.price" class="text-red-500">{{ errors.price }}</div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-300 dark:font-medium">Add Treatment</button>
      </form>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import Sidebar from './sidebar.vue';
  import { useRoute, useRouter } from 'vue-router';
  const router = useRouter();
  const treatment = ref({
    treatment_name: '',
    description: '',
    waiting_time: '',
    price: '',
  });
  const errors = ref({});

  const addTreatment = async () => {
    try {
      const token = localStorage.getItem('token');
      const isFormValid = validateForm();

      if (isFormValid) {
        const response = await axios.post('http://127.0.0.1:8000/api/treatments', treatment.value, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        if (response.status === 200) {
          document.getElementById('error-message').textContent = '';
        }
        router.push('/show/treatments');
      }
    } catch (error) {
      console.error(error);
      if (error.response && error.response.status !== 200) {
        const errorMessage = error.response.data.message;
        // Wyświetl komunikat błędu nad formularzem
        document.getElementById('error-message').textContent = errorMessage;
      }
    }
  };

  const validateForm = () => {
    errors.value = {};

    if (!treatment.value.treatment_name) {
      errors.value.treatment_name = 'Treatment Name is required';
    }

    if (!treatment.value.description) {
      errors.value.description = 'Description is required';
    }

    if (!treatment.value.waiting_time) {
      errors.value.waiting_time = 'Waiting Time is required';
    } else if (!/^\d{2}:\d{2}:\d{2}$/.test(treatment.value.waiting_time)) {
      errors.value.waiting_time = 'Waiting Time must be in the format HH:MM:SS';
    }

    if (!treatment.value.price) {
      errors.value.price = 'Price is required';
    } else if (isNaN(parseFloat(treatment.value.price))) {
      errors.value.price = 'Price must be a number';
    }

    return Object.keys(errors.value).length === 0;
  };
  </script>
