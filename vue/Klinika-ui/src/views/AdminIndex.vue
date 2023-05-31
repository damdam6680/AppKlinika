<script setup>
import { initFlowbite } from 'flowbite'
import {ref, onMounted} from 'vue'
import Sidebar from './sidebar.vue' ;
import axios from 'axios';


onMounted(() => {
    initFlowbite();
})


const user = ref();

onMounted(async () => {
  // Pobierz token z Local Storage
  const token = localStorage.getItem('token');

  try {
    const response = await axios.get('http://127.0.0.1:8000/api/user', {
      headers: {
        Authorization: `Bearer ${token}`, // Dodaj token jako bearer token
      },
    });

    // Przetwórz odpowiedź serwera
    console.log(response.data);
  } catch (error) {
    console.error(error);
  }
});


</script>

<template>

<Sidebar></Sidebar>


</template>
