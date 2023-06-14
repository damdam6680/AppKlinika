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
                  Name
                </th>
                <th scope="col" class="px-6 py-3">
                  Role
                </th>
                <th scope="col" class="px-6 py-3"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {{ user.email }}
                </td>
                <td class="px-6 py-4">
                  {{ user.name }}
                </td>
                <td class="px-6 py-4">
                  {{ user.role }}
                </td>
                <td class="px-6 py-4 flex items-center">
                  <router-link :to="{ name: 'EditUsers', params: { userId: user.id } }" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</router-link>
                  <button @click="deleteUser(user.id)" class="ml-4 px-3 py-2 text-xs font-medium leading-4 text-white bg-red-600 hover:bg-red-700 rounded-lg">Delete</button>
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
  import Sidebar from './sidebar.vue';

  const users = ref([]);
  const patients = ref([]);
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
    } catch (error) {
      console.error(error);
    }
  };

  const deleteUser = async (userId) => {
    const token = localStorage.getItem('token');

    try {
      // Delete associated records in the `patients` table first
      const patientsResponse = await axios.get(`http://127.0.0.1:8000/api/patients?user_id=${userId}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      //patients.value = patientsResponse.data.data[0].id;
      //console.log(patients.value);
      await axios.delete(`http://127.0.0.1:8000/api/patients/${patients.value}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      // Then delete the user
      await axios.delete(`http://127.0.0.1:8000/api/user/${userId}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      // Refresh the user list after deletion
      await fetchUsers('http://127.0.0.1:8000/api/user');
    } catch (error) {
      console.error(error);
    }
  };

  onMounted(async () => {
    const initialUrl = 'http://127.0.0.1:8000/api/user';

    await fetchUsers(initialUrl);
  });
  </script>
