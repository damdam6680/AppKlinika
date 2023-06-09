<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Sidebar from './sidebar.vue';
   const patients = ref([]);
    const emails = ref({});
    const pagination = ref({});

    const fetchUsers = async (url) => {
    const token = localStorage.getItem('token');

  try {
    const response = await axios.get(url, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    patients.value = response.data.data;
    pagination.value = response.data.links;

    // Pobierz wartości email dla każdego dentysty
    response.data.data.forEach((patient) => {
      emails.value[patient.id] = patient.user.email;
    });
  } catch (error) {
    console.error(error);
  }
};

const deleteUser = async (userId) => {
  const token = localStorage.getItem('token');

  try {
    await axios.delete(`http://127.0.0.1:8000/api/patients/${userId}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    // Pomyślnie usunięto użytkownika, możesz wykonać dodatkowe czynności, np. odświeżenie listy użytkowników
    // Przeładuj użytkowników po usunięciu
    await fetchUsers('http://127.0.0.1:8000/api/patients');
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  fetchUsers('http://127.0.0.1:8000/api/patients');
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
                  Email
                </th>
                <th scope="col" class="px-6 py-3">
                  First Name
                </th>
                <th scope="col" class="px-6 py-3">
                  Last Name
                </th>
                <th scope="col" class="px-6 py-3">
                  Pesel
                </th>
                <th scope="col" class="px-6 py-3">
                  Address
                </th>
                <th scope="col" class="px-6 py-3">
                  Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                  Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Birthday
                </th>
                <th scope="col" class="px-6 py-3">
                  Edit Patients
                </th>
                <th scope="col" class="px-6 py-3">
                  Edit User
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete
                  </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="patient in patients" :key="patient.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ emails[patient.id] }}
                </td>
                <td class="px-6 py-4">
                  {{ patient.first_name }}
                </td>
                <td class="px-6 py-4">
                  {{ patient.last_name }}
                </td>
                <td class="px-6 py-4">
                  {{ patient.pesel }}
                </td>
                <td class="px-6 py-4">
                  {{ patient.address }}
                </td>
                <td class="px-6 py-4">
                  {{ patient.phone }}
                </td>
                <td class="px-6 py-4">
                  {{ patient.gender }}
                </td>
                <td class="px-6 py-4">
                  {{ patient.birthday }}
                </td>
                <td class="px-6 py-4">
                  <router-link :to="{ name: 'EditPatients', params: { userId: patient.id } }" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</router-link>
                </td>
                <td class="px-6 py-4">
                  <router-link :to="{ name: 'EditUsers', params: { userId: patient.user_id } }" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit User</router-link>
                </td>
                <td class="px-6 py-4 ">
                    <button @click="deleteUser(patient.id)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-red-600 hover:bg-red-700 rounded-lg">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mt-4">
          <button v-if="pagination.prev_page_url" @click="fetchPatients(pagination.prev_page_url)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Previous</button>
          <button v-if="pagination.next_page_url" @click="fetchPatients(pagination.next_page_url)" class="ml-2 px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Next</button>
        </div>
      </div>
    </div>
  </template>
