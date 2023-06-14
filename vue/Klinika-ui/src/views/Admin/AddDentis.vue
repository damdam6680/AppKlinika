<template>
    <Sidebar></Sidebar>
    <div class="p-4 sm:ml-64 max-w-screen-2xl">
        <form class="p-10" @submit.prevent="createDentist">
          <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" v-model="user.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          </div>
          <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" v-model="user.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          </div>
          <div class="mb-6">
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" id="role" v-model="user.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          </div>
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
      </div>
  </template>

  <script setup>
  import Sidebar from './sidebar.vue';
  import { ref } from 'vue';
  import axios from 'axios';

  const user = ref({
    name: '',
    email: '',
    password: '',
  });

  async function createDentist() {
    try {
      // Pobierz token z lokalnego magazynu (np. z localStorage lub Vuex)
      const token = localStorage.getItem('token');

      const response = await axios.post('http://127.0.0.1:8000/api/appointments/create', {
        name: user.value.name,
        email: user.value.email,
        password: user.value.password,
      }, {
        headers: {
          Authorization: `Bearer ${token}`, // Dodaj token do nagłówka żądania
        },
      });

      console.log(response.data);
      // Możesz dodać logikę obsługi odpowiedzi, np. wyświetlanie komunikatu sukcesu
    } catch (error) {
      console.error(error);
      // Możesz dodać logikę obsługi błędów, np. wyświetlanie komunikatu o błędzie
    }
  }
  </script>

