<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import navbar from '../navbar.vue'

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
    console.log(  appointments.value);
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  fetchAppointments('http://127.0.0.1:8000/api/appointments/patient/list');
});
</script>

<template>
    <navbar></navbar>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidenav">
    <div class="overflow-y-auto py-5 px-3 h-full bg-blue-700 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <ul class="space-y-2">
            <li>
                <a href="/patient/home" class="flex items-center p-2 text-base font-normal text-sky-500 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true" class="w-6 h-6 text-sky-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Go back</span>
                </a>
            </li>


        </ul>

    </div>

    </aside>

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
              <th scope="col" class="px-6 py-3">
                Visit date
              </th>
              <th scope="col" class="px-6 py-3">
                Accepted
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
                {{ appointment.dentist.first_name }} {{ appointment.dentist.last_name }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.treatment.treatment_name }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.visit_time}} - {{ appointment.visit_end }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.is_accepted }}
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
