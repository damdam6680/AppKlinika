<!-- dodac przyciski  -->
<!-- dodac widok doktorów -->
<!-- dodac tabele z zabiegami -->
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import navbar from './navbar.vue';

const users = ref([]);
const appointments = ref([])
const email = ref('');
const user_name = ref('');

const fetchUser = async () => {
  const token = localStorage.getItem('token');

  try {
    const response = await axios.get('http://127.0.0.1:8000/api/patients/me', {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    users.value = response.data; // Assign the user ID to the ref
    email.value = response.data.user.email; // Assign the email to the ref
    user_name.value = response.data.user.name;
    console.log(email.value);

    console.log(users.value);
  } catch (error) {
    console.error(error);
  }
};

const fetchAppotment = async () => {
  const token = localStorage.getItem('token');

  try {
    const response = await axios.get('http://127.0.0.1:8000/api/appointments/patient/list', {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    appointments.value = response.data.data; // Assign the user ID to the ref
    console.log(appointments.value);

  } catch (error) {
    console.error(error);
  }
};



onMounted(() => {
  fetchUser();
  fetchAppotment();
});

</script>

<template>

    <navbar></navbar>



    <div class="bg-gray-100 h-full">


           <div class="container mx-auto my-5 p-5">
               <div class="md:flex no-wrap md:-mx-2 ">
                   <!-- Left Side -->
                   <div class="w-full  md:w-3/12 md:mx-2">
                       <!-- Profile Card -->
                       <div class="bg-white p-6 h-full border-t-4 border-green-400">
                           <div class="image overflow-hidden">

                           </div>
                           <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{user_name}}</h1>
                           <a href="/apoitment">
                            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium my-8 mb-10 rounded-lg text-sm px-5 py-2.5 mr-2 w-full dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                              Make Appointment
                            </button>
                          </a >
                           <button   type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-10 dark:bg-blue-600 dark:hover:bg-blue-700 w-full focus:outline-none dark:focus:ring-blue-800"  @click="$router.push('/show/appointment/patient')">Show Appotments</button>
                           <ul
                               class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-2  divide-y rounded shadow-sm">
                               <li class="flex items-center py-3">
                                   <span>Status</span>
                                   <span class="ml-auto"><span
                                           class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                               </li>
                               <li class="flex items-center py-3">
                                   <span>Member since</span>
                                   <span class="ml-auto">Nov 07, 2016</span>
                               </li>
                           </ul>
                       </div>
                       <!-- End of profile card -->

                   </div>
                   <!-- Right Side -->
                   <div class="w-full md:w-9/12 mx-2 h-64">
                       <!-- Profile tab -->
                       <!-- About Section -->
                       <div class="bg-white p-3 shadow-sm rounded-sm">
                           <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                               <span clas="text-green-500">
                                   <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                       stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                           d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                   </svg>
                               </span>
                               <span class="tracking-wide">About</span>
                           </div>
                           <div class="text-gray-700">
                               <div class="grid md:grid-cols-2 text-sm">
                                   <div class="grid grid-cols-2">
                                       <div class="px-4 py-2 font-semibold">First Name</div>
                                       <div class="px-4 py-2">{{ users.first_name }}</div>
                                   </div>
                                   <div class="grid grid-cols-2">
                                       <div class="px-4 py-2 font-semibold">Last Name</div>
                                       <div class="px-4 py-2">{{ users.last_name }}</div>
                                   </div>
                                   <div class="grid grid-cols-2">
                                       <div class="px-4 py-2 font-semibold">Gender</div>
                                       <div class="px-4 py-2">{{users.gender}}</div>
                                   </div>
                                   <div class="grid grid-cols-2">
                                       <div class="px-4 py-2 font-semibold">Contact No.</div>
                                       <div class="px-4 py-2">{{ users.phone}}</div>
                                   </div>
                                   <div class="grid grid-cols-2">
                                       <div class="px-4 py-2 font-semibold">Permanant Address</div>
                                       <div class="px-4 py-2">{{users.address}}</div>
                                   </div>
                                   <div class="grid grid-cols-2">
                                       <div class="px-4 py-2 font-semibold"></div>
                                       <div class="px-4 py-2">
                                           <a class="text-blue-800" href="mailto:{{email}}">{{email}}</a>
                                       </div>
                                   </div>
                                   <div class="grid grid-cols-2">
                                       <div class="px-4 py-2 font-semibold">Birthday</div>
                                       <div class="px-4 py-2">{{users.birthday}}</div>
                                   </div>
                               </div>
                           </div>
                           <router-link to="/edit/patients/data" class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Edit Informations</router-link>
                       </div>
                       <!-- End of about section -->

                       <div class="my-4"></div>

                       <!-- Experience and education -->
                       <div class="bg-white p-3 shadow-sm rounded-sm">

                        <div class="grid grid-cols-2">
                            <ul v-for="appointment in appointments" :key="appointment.id" class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                            <li  v-if="appointment.is_accepted === 1"   class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                  {{ appointment.treatment.treatment_name }}   {{ appointment.visit_date }}   {{ appointment.visit_time}}     {{ appointment.visit_end}}
                            </li>
                            <li v-if="appointment.is_accepted === 0" class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                {{ appointment.treatment.treatment_name }}   {{ appointment.visit_date }}   {{ appointment.visit_time}}     {{ appointment.visit_end}}
                            </li>
                            </ul>
                        </div>
                        </div>
                       <!-- End of profile tab -->
                   </div>
               </div>
           </div>
       </div>








</template>
