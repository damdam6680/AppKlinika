<template>
    <Sidebar></Sidebar>
    <div class="p-4 sm:ml-64 max-w-screen-2xl">
        <div class="mb-6 text-red-500">
            <div id="error-message" class="text-red-500"></div>
        </div>
      <form class="p-10" @submit.prevent="updateUser">
        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
          <input type="email" id="email" v-model="user.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
          <input type="text" id="name" v-model="user.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
          <input type="text" id="role" v-model="user.role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router'; // Importuj useRoute i useRouter z vue-router
  import Sidebar from './sidebar.vue';

  const user = ref({ email: '', name: '', role: '' });
  const route = useRoute(); // Użyj useRoute do uzyskania dostępu do obiektu $route
  const router = useRouter(); // Użyj useRouter do uzyskania dostępu do routera

  const fetchUser = async () => {
    const token = localStorage.getItem('token');
    const userId = route.params.userId; // Odczytaj parametr userId z obiektu route

    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/users/${userId}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      // Ustaw dane użytkownika
      user.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };

  const updateUser = async () => {
    const token = localStorage.getItem('token');
    const userId = route.params.userId; // Odczytaj parametr userId z obiektu route

    try {
        const response =  await axios.put(`http://127.0.0.1:8000/api/users/${userId}`, user.value, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      if (response.status === 200) {
            document.getElementById('error-message').textContent = '';
        }
      // Przekieruj użytkownika do innej ścieżki po zaktualizowaniu danych
      router.push('/show/users');
    } catch (error) {
      console.error(error);

      if (error.response && error.response.status !== 200) {
            const errorMessage = error.response.data.message;
            // Wyświetl komunikat błędu nad formularzem
            document.getElementById('error-message').textContent = errorMessage;
        }

    }
  };

  onMounted(async () => {
    await fetchUser();
  });
  </script>
