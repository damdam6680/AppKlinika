<template>
    <Sidebar></Sidebar>
    <div class="p-4 sm:ml-64 max-w-screen-2xl">
      <form class="p-10" @submit.prevent="updateTreatment">
        <div class="mb-6">
          <label for="treatmentName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Treatment Name</label>
          <input type="text" id="treatmentName" v-model="treatment.treatment_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
          <textarea id="description" v-model="treatment.description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
        </div>
        <div class="mb-6">
          <label for="waitingTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waiting Time (hh:mm:ss)</label>
          <input type="text" id="waitingTime" v-model="treatment.waiting_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
          <input type="number" id="price" v-model="treatment.price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Sidebar from './sidebar.vue';
  import { useRouter } from 'vue-router';

  const router = useRouter();
  const userId = router.currentRoute.value.params.userId;
  const treatment = ref({});

  const fetchTreatment = async () => {
    const token = localStorage.getItem('token');

    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/treatments/${userId}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      treatment.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };

  const updateTreatment = async () => {
    const token = localStorage.getItem('token');

    try {
      await axios.put(`http://127.0.0.1:8000/api/treatments/${userId}`, treatment.value, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      router.push('/ShowTretments');
    } catch (error) {
      console.error(error);
    }
  };

  onMounted(() => {
    fetchTreatment();
  });
  </script>
