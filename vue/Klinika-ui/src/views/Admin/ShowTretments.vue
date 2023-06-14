<template>
    <Sidebar></Sidebar>
    <div class="p-4 sm:ml-64 max-w-screen-2xl">
      <div class="mx-auto flex-1 p-3">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Treatment Name
                </th>
                <th scope="col" class="px-6 py-3">
                  Description
                </th>
                <th scope="col" class="px-6 py-3">
                  Waiting Time
                </th>
                <th scope="col" class="px-6 py-3">
                  Price
                </th>
                <th scope="col" class="px-6 py-3">
                  Edit Treatment
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="treatment in treatments" :key="treatment.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {{ treatment.treatment_name }}
                </td>
                <td class="px-6 py-4">
                  {{ treatment.description }}
                </td>
                <td class="px-6 py-4">
                  {{ treatment.waiting_time }}
                </td>
                <td class="px-6 py-4">
                  {{ treatment.price }}
                </td>
                <td class="px-6 py-4">
                  <router-link :to="{ name: 'EditTreatments', params: { userId: treatment.id } }" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</router-link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Sidebar from './sidebar.vue';

  const treatments = ref([]);

  const fetchTreatments = async () => {
    const token = localStorage.getItem('token');

    try {
      const response = await axios.get('http://127.0.0.1:8000/api/treatments', {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      treatments.value = response.data.data;
    } catch (error) {
      console.error(error);
    }
  };

  onMounted(() => {
    fetchTreatments();
  });
  </script>
