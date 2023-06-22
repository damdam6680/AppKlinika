<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

// Data bindings
const email = ref('');
const password = ref('');

// Vue Router
const router = useRouter();

// Pobierz token z Local Storage

// Logowanie
const login = () => {
  const apiUrl = 'http://localhost:8000/api/auth/login';

  // Wykonaj żądanie logowania z użyciem email i hasła
  axios.post(apiUrl, {
    email: email.value,
    password: password.value
  })
    .then(response => {
      // Obsługa sukcesu logowania
      console.log(response.data);

      const token = response.data.token;
      const id = response.data.id;
      localStorage.setItem('token', token);
      localStorage.setItem('id', id);
      // Sprawdź rolę użytkownika
      const role = response.data.role;
      if (role === 'user') {
        // Przekieruj użytkownika do widoku userindex.vue
        router.push('/patient/home');
      }
      if (role === 'admin') {
        // Przekieruj użytkownika do widoku userindex.vue
        router.push('/admin/home');
      }
      if (role === 'dentist') {
        // Przekieruj użytkownika do widoku userindex.vue
        router.push('/dentits/home');
      }
    })
    .catch(error => {
      // Obsługa błędu logowania
      console.error(error);
    });
};
</script>
<template>
    <!-- Container -->
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
        <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12
            px-6 py-10 sm:px-10 sm:py-6
            bg-white rounded-lg shadow-md lg:shadow-lg">

            <!-- Card Title -->
            <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800">
                Login
            </h2>

            <form class="mt-10" @submit.prevent="login">
                <!-- Email Input -->
                <!-- Email Input -->
                <input v-model="email" id="email" type="email" name="email" placeholder="e-mail address" autocomplete="email"
                class="block w-full py-3 px-1 mt-2
                text-gray-800 appearance-none
                border-b-2 border-gray-100
                focus:text-gray-500 focus:outline-none focus:border-gray-200"
                required />

                <!-- Password Input -->
                <input v-model="password" id="password" type="password" name="password" placeholder="password" autocomplete="current-password"
                class="block w-full py-3 px-1 mt-2 mb-4
                text-gray-800 appearance-none
                border-b-2 border-gray-100
                focus:text-gray-500 focus:outline-none focus:border-gray-200"
                required />


                <!-- Auth Buttton -->
                <button type="submit"
                    class="w-full py-3 mt-10 bg-gray-800 rounded-sm
                    font-medium text-white uppercase
                    focus:outline-none hover:bg-gray-700 hover:shadow-none">
                    Login
                </button>

                <!-- Another Auth Routes -->
                <div class="sm:flex sm:flex-wrap mt-8 sm:mb-4 text-sm text-center">
                    <a href="/register" class="flex-2 underline">
                        Create an Account
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</template>
