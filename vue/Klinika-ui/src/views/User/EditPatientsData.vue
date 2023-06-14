<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import navbar from '../navbar.vue';
import { useRoute, useRouter } from 'vue-router';

const user = ref({ first_name: '', last_name: '', pesel: '', address: '', phone: '', gender: '', birthday: '' });
const router = useRouter();

const fetchUser = async () => {
  const token = localStorage.getItem('token');

  try {
    const response = await axios.get('http://127.0.0.1:8000/api/patients/me', {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    user.value = response.data; // Assign the user ID to the ref


    console.log(user.value);
  } catch (error) {
    console.error(error);
  }
};

const updateUser = async () => {
    const token = localStorage.getItem('token');
     // Odczytaj parametr userId z obiektu route

    try {
      await axios.put(`http://127.0.0.1:8000/api/patients/me`, user.value, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      // Przekieruj użytkownika do innej ścieżki po zaktualizowaniu danych
      router.push('/patient/home');
    } catch (error) {
      console.error(error);
    }
  };



onMounted(() => {
  fetchUser();
});

</script>
<template>
        <navbar></navbar>

            <div class="p-10 ">
              <form @submit.prevent="updateUser">
                <div class="mb-6">
                  <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                  <input type="text" id="first_name" v-model="user.first_name" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-6">
                  <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                  <input type="text" id="last_name" v-model="user.last_name" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-6">
                  <label for="pesel" class="block mb-2 text-sm font-medium text-gray-900">PESEL</label>
                  <input type="text" id="pesel" v-model="user.pesel" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-6">
                  <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                  <input type="text" id="address" v-model="user.address" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-6">
                  <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                  <input type="text" id="phone" v-model="user.phone" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-6">
                  <label for="gender" class="block mb-2 text-sm font-medium  text-gray-900">Gender</label>
                  <select id="gender" v-model="user.gender" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="">Select Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                  </select>
                </div>
                <div class="mb-6">
                  <label for="birthday" class="block mb-2 text-sm font-medium text-white">Birthday</label>
                  <input type="date" id="birthday" v-model="user.birthday" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
              </form>
            </div>



</template>
