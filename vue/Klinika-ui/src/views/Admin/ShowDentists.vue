<template>
    <Sidebar></Sidebar>
    <div class="p-4 sm:ml-64">
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
                  Specialization
                </th>
                <th scope="col" class="px-6 py-3">
                  Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit Dentist
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Edit User
                  </th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ emails[user.id] }}
                  </td>
                  <td class="px-6 py-4">
                    {{ user.first_name }}
                  </td>
                  <td class="px-6 py-4">
                    {{ user.last_name }}
                  </td>
                  <td class="px-6 py-4">
                    {{ user.specialization }}
                  </td>
                  <td class="px-6 py-4">
                    {{ user.phone_number }}
                  </td>
                  <td class="px-6 py-4">
                    <router-link :to="{ name: 'EditDentists', params: { userId: user.id } }" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</router-link>
                 </td>
                  <td class="px-6 py-4">
                    <router-link :to="{ name: 'EditUsers', params: { userId: user.user_id } }" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit User</router-link>
                  </td>
                </tr>
              </tbody>
          </table>
        </div>
        <div class="mt-4">
          <button v-if="pagination.prev_page_url" @click="fetchUsers(pagination.prev_page_url)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Previous</button>
          <button v-if="pagination.next_page_url" @click="fetchUsers(pagination.next_page_url)" class="ml-2 px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Next</button>
        </div>
      </div>
    </div>
  </template>

  <script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Sidebar from '../sidebar.vue';

const users = ref([]);
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

    users.value = response.data.data;
    pagination.value = response.data.links;

    // Pobierz wartości email dla każdego dentysty

  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  fetchUsers('http://127.0.0.1:8000/api/dentists');
});
</script>

