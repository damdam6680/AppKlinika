<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';

let name1 = '';
let email = '';
let password = '';

const router = useRouter();

const register = async () => {
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/auth/register', {
      name: name1,
      email: email,
      password: password
    });

    // Przekierowanie do strony logowania po udanej rejestracji
    router.push('/login');

    // Obsługa sukcesu, np. wyświetlenie komunikatu
    console.log(response.data);
  } catch (error) {
    // Obsługa błędu, np. wyświetlenie komunikatu lub logowanie go w konsoli
    console.error(error.response.data);
  }
};
</script>

<template>
  <div class="flex flex-col min-h-screen bg-gray-100">
    <!-- Auth Card Container -->
    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
      <div class="flex">
        <span class="text-center font-bold my-20 mx-auto">
          <a href="/" target="_blank" class="text-blue-600">
            Go Back
          </a>
        </span>
      </div>

      <!-- Auth Card -->
      <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12 px-6 py-10 sm:px-10 sm:py-6 bg-white rounded-lg shadow-md lg:shadow-lg">
        <!-- Card Title -->
        <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800">
          Register
        </h2>

        <form class="mt-10" @submit.prevent="register">
          <!-- Email Input -->
          <input v-model="name1" id="name1" type="text" name="name1" placeholder="name " autocomplete="name1"
            class="block w-full py-3 px-1 mt-2 text-gray-800 appearance-none border-b-2 border-gray-100 focus:text-gray-500 focus:outline-none focus:border-gray-200"
            required />

          <input v-model="email" id="email" type="email" name="email" placeholder="e-mail address" autocomplete="email"
            class="block w-full py-3 px-1 mt-2 text-gray-800 appearance-none border-b-2 border-gray-100 focus:text-gray-500 focus:outline-none focus:border-gray-200"
            required />

          <!-- Password Input -->
          <input v-model="password" id="password" type="password" name="password" placeholder="password" autocomplete="current-password"
            class="block w-full py-3 px-1 mt-2 mb-4 text-gray-800 appearance-none border-b-2 border-gray-100 focus:text-gray-500 focus:outline-none focus:border-gray-200"
            required />

          <!-- Auth Button -->
          <button type="submit" class="w-full py-3 mt-10 bg-gray-800 rounded-sm font-medium text-white uppercase focus:outline-none hover:bg-gray-700 hover:shadow-none">
            Register
          </button>

          <!-- Another Auth Routes -->
        </form>
      </div>
    </div>
  </div>
</template>
