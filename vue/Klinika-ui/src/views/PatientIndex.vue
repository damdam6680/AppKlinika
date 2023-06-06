<!-- dodac przyciski  -->
<!-- dodac widok doktorów -->
<!-- dodac tabele z zabiegami -->
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import navbar from './navbar.vue';

const users = ref([]);
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

onMounted(() => {
  fetchUser();
});

</script>

<template>

    <navbar></navbar>



    <div class="bg-gray-100">


           <div class="container mx-auto my-5 p-5">
               <div class="md:flex no-wrap md:-mx-2 ">
                   <!-- Left Side -->
                   <div class="w-full  md:w-3/12 md:mx-2">
                       <!-- Profile Card -->
                       <div class="bg-white p-6 h-full border-t-4 border-green-400">
                           <div class="image overflow-hidden">

                           </div>
                           <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{user_name}}</h1>
                           <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium my-8 mb-10 rounded-lg text-sm px-5 py-2.5 mr-2 w-full dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Make Appoitment</button>
                           <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-10 dark:bg-blue-600 dark:hover:bg-blue-700 w-full focus:outline-none dark:focus:ring-blue-800">Show Doctors</button>
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
                           <router-link to="/EditPatientsData" class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Edit Informations</router-link>
                       </div>
                       <!-- End of about section -->

                       <div class="my-4"></div>

                       <!-- Experience and education -->
                       <div class="bg-white p-3 shadow-sm rounded-sm">

                           <div class="grid grid-cols-2">
                               <div>
                                   <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                       <span clas="text-green-500">
                                           <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                               stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                   d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                           </svg>
                                       </span>
                                       <span class="tracking-wide">Experience</span>
                                   </div>
                                   <ul class="list-inside space-y-2">
                                       <li>
                                           <div class="text-teal-600">Owner at Her Company Inc.</div>
                                           <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                       </li>
                                       <li>
                                           <div class="text-teal-600">Owner at Her Company Inc.</div>
                                           <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                       </li>
                                       <li>
                                           <div class="text-teal-600">Owner at Her Company Inc.</div>
                                           <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                       </li>
                                       <li>
                                           <div class="text-teal-600">Owner at Her Company Inc.</div>
                                           <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                       </li>
                                   </ul>
                               </div>
                               <div>
                                   <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                       <span clas="text-green-500">
                                           <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                               stroke="currentColor">
                                               <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                               <path fill="#fff"
                                                   d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                   d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                           </svg>
                                       </span>
                                       <span class="tracking-wide">Education</span>
                                   </div>
                                   <ul class="list-inside space-y-2">
                                       <li>
                                           <div class="text-teal-600">Masters Degree in Oxford</div>
                                           <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                       </li>
                                       <li>
                                           <div class="text-teal-600">Bachelors Degreen in LPU</div>
                                           <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                       </li>
                                   </ul>
                               </div>
                           </div>
                           <!-- End of Experience and education grid -->
                       </div>
                       <!-- End of profile tab -->
                   </div>
               </div>
           </div>
       </div>








</template>
