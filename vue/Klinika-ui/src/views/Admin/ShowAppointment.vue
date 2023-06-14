<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Sidebar from './sidebar.vue';

const appointments = ref([]);
const pagination = ref({});

const fetchAppointments = async (url) => {
  const token = localStorage.getItem('token');

  try {
    const response = await axios.get(url, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    appointments.value = response.data.data;
    pagination.value = response.data.links;

  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  fetchAppointments('http://127.0.0.1:8000/api/appointments');
});
</script>

<template>
  <Sidebar></Sidebar>
  <div class="p-4 sm:ml-64 max-w-screen-2xl">
    <div class="mx-auto flex-1 p-3">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                Patients Name
              </th>
              <th scope="col" class="px-6 py-3">
                Dentist
              </th>
              <th scope="col" class="px-6 py-3">
                Treatment name
              </th>
              <th scope="col" class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="appointment in appointments" :key="appointment.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ appointment.patient.first_name }} {{ appointment.patient.last_name }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.dentist.last_name }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.treatment.treatment_name }}
              </td>
              <td class="px-6 py-4 flex items-center">
                <button @click="deleteUser(appointment.id)" class="ml-4 px-3 py-2 text-xs font-medium leading-4 text-white bg-red-600 hover:bg-red-700 rounded-lg">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="mt-4">
        <button v-if="pagination.prev_page_url" @click="fetchAppointments(pagination.prev_page_url)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Previous</button>
        <button v-if="pagination.next_page_url" @click="fetchAppointments(pagination.next_page_url)" class="ml-2 px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Next</button>
      </div>
    </div>
  </div>
</template>
