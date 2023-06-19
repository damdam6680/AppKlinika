<template>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a  class="flex items-center">
              <img src="\public\images\logo.png" class="h-8 mr-3" alt="Flowbite Logo" />
              <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
          </a>
          <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          </button>
          <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
              <li>
                <button id="loginButton" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <a href="/login">Login</a>
                  </button>
                  <button id="registerButton" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-3">
                    Sign up
                  </button>
              </li>
              <li>

                  <button id="logoutButton" type="button" class="hidden text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Logout
                  </button>
              </li>

            </ul>
          </div>
        </div>
      </nav>

  </template>

  <script setup>
  import { ref, onMounted } from 'vue';
  import { initFlowbite } from 'flowbite'
  onMounted(() => {
    // Sprawdź, czy istnieje token
    const hasToken = localStorage.getItem('token'); // Tutaj należy zaimplementować odpowiednią logikę weryfikacji tokenu
    initFlowbite();
    // Pobierz przyciski
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const logoutButton = document.getElementById('logoutButton');

    // Jeśli istnieje token, ukryj przyciski "Login" i "Sign up", pokaż przycisk "Logout"
    if (hasToken && hasToken.length > 0) {
      loginButton.style.display = 'none';
      registerButton.style.display = 'none';
      logoutButton.style.display = 'inline-block';
    }

    // Dodaj obsługę kliknięcia przycisku "Logout"
    logoutButton.addEventListener('click', () => {
      // Wywołaj funkcję logout API, aby unieważnić token i zrealizować wylogowanie
      // Tutaj można dodać odpowiednie żądanie HTTP, aby unieważnić token serwerowo
      // Po zakończeniu wylogowania można przekierować użytkownika na stronę logowania lub inny widok

      // Na potrzeby przykładu usuniemy token z lokalnego składowania
      localStorage.removeItem('token');

      // Ukryj przycisk "Logout" i pokaż przyciski "Login" i "Sign up"
      logoutButton.style.display = 'none';
      loginButton.style.display = 'inline-block';
      registerButton.style.display = 'inline-block';


      window.location.href = '/';
    });
  });
  </script>
