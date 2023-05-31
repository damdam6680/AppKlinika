<script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Sidebar from '../sidebar.vue';

  const users = ref([]);
  const pagination = ref({});

  const fetchUsers = async (url) => {
    const token = localStorage.getItem('token');

    try {
      const response = await axios.get(url, {
        headers: {
          Authorization: `Bearer ${token}`, // Dodaj token jako bearer token
        },
      });

      // Pobierz listę użytkowników
      const userList = response.data.data;

      // Pobierz szczegółowe informacje o każdym użytkowniku
      const userDetailsPromises = userList.map(user => {
        return axios.get(`http://127.0.0.1:8000/api/user/${user.user_id}`, {
          headers: {
            Authorization: `Bearer ${token}`, // Dodaj token jako bearer token
          },
        });
      });

      // Poczekaj na wszystkie zapytania o szczegóły użytkowników
      const userDetailsResponses = await Promise.all(userDetailsPromises);

      // Przetwórz odpowiedzi serwera
      users.value = userList.map((user, index) => {
        const userDetails = userDetailsResponses[index].data;

        return {
          user_id: user.user_id,
          email: userDetails.email,
          first_name: user.first_name,
          last_name: user.last_name,
          specialization: user.specialization,
          phone_number: user.phone_number,
        };
      });

      pagination.value = response.data.links;
    } catch (error) {
      console.error(error);
    }
  };

  onMounted(async () => {
    const initialUrl = 'http://127.0.0.1:8000/api/dentists'; // Ustaw tutaj URL do pierwszej strony danych

    await fetchUsers(initialUrl);
  });
</script>

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
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.user_id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ user.email }}
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
            </tr>
          </tbody>
        </table>
      </div>
      <div class="mt-4">
        <button v-if="pagination.prev_page_url" @click="fetchUsers(pagination.prev_page_url)">Previous</button>
        <button v-if="pagination.next_page_url" @click="fetchUsers(pagination.next_page_url)">Next</button>
      </div>
    </div>
  </div>
</template>
