
<!-- dodac wybór czasu i przyciki do tabel -->
<script>
import 'form-wizard-vue3/dist/form-wizard-vue3.css';
import Wizard from 'form-wizard-vue3';
import navbar from '../navbar.vue';

const dr = ref([]);

export default {
  name: 'App',
  components: {
    Wizard,
    navbar,
  },
  data() {
    return {
      currentTabIndex: 0,
    };
  },
  methods: {
    onChangeCurrentTab(index, oldIndex) {
      console.log(index, oldIndex);
      this.currentTabIndex = index;
    },
    onTabBeforeChange() {
      if (this.currentTabIndex === 0) {
        console.log('First Tab');
      }
      console.log('All Tabs');
    },
    wizardCompleted() {
      console.log('Wizard Completed');
    },
    chooseDentist(dentistId) {
      // Zapisz wybór użytkownika w zmiennej
        dr.value = dentistId;
        console.log("did")
        console.log(dentistId);
      // Wyświetl powiadomienie
      console.log("dr")
        console.log(dr.valuwa);
    },

    chooseTreatment(treatmentId) {
      // Zapisz wybór użytkownika w zmiennej
      this.selectedTreatment = treatmentId;

      // Wyświetl powiadomienie
      console.log(treatmentId);
    },
  },
  computed: {
    nextButtonOptions() {
      return this.currentTabIndex === 3
        ? {
            text: 'test',
            icon: 'check',
            hideIcon: true, // default false but selected for sample
            hideText: false, // default false but selected for sample
            disabled: true,
          }
        : { disabled: false };
    },
  },
};
</script>

<script setup>
import { ref, onMounted, watch   } from 'vue';
import axios from 'axios';


const date = ref(new Date());

// Watch for changes in the date variable
watch(date, (newDate) => {
  console.log('Selected date:', newDate);
});



const time = ref({
  hours: new Date().getHours(),
  minutes: new Date().getMinutes(),
});

// Watch for changes in the time variable
watch(time, (newTime) => {
  console.log('Selected time:', newTime);
});



const users = ref([]);
const emails = ref({});
const pagination = ref({});



const fetchUsers = async (url) => {
  const token = localStorage.getItem('token');

  try {
    const response = await axios.get(url, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    users.value = response.data.data;
    pagination.value = response.data.links;




    // Pobierz wartości email dla każdego dentysty
    response.data.data.forEach((dentist) => {
      emails.value[dentist.id] = dentist.user.email;
    });
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  fetchUsers('http://127.0.0.1:8000/api/dentists');
});

const treatments = ref([]);
const pagination1 = ref({});

const fetchTreatments = async (url) => {
  const token = localStorage.getItem('token');

  try {
    const response = await axios.get(url, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    treatments.value = response.data.data;
    pagination1.value = response.data.links;


  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
    fetchTreatments('http://127.0.0.1:8000/api/treatments');
});


</script>


<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #b8bec4;
  background-color:  #374151;;
height: 100%;
}
.fw-body {
    background-color: #374151;

}
.fw-body-list{


    background-color: #374151;
}
.form-wizard-vue {
    border: 0;

}
.fw-overflow-scroll {
    border: 0;

}
.fw-card{
    border: 0;

}

</style>

<template>
  <navbar></navbar>
  <div id="app">
    <div>
      <Wizard
        squared-tabs
        card-background
        navigable-tabs
        scrollable-tabs
        :nextButton="nextButtonOptions"
        :custom-tabs="[
          {
            title: 'Choose doctor',
          },
          {
            title: 'Choose treatments',
          },
          {
            title: 'Choose Date',
          },
          {
            title: 'Summary',
          }
        ]"
        :beforeChange="onTabBeforeChange"
        @change="onChangeCurrentTab"
        @complete:wizard="wizardCompleted"
      >
        <div v-if="currentTabIndex === 0">
          <div class="mx-auto flex-1 p-3">
            <div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
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
                    <th scope="col" class="px-6 py-3">
                      Choose Dentist
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                    <td class="px-6 py-4">
                      <button @click="chooseDentist(user)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Choose</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="mt-4">
              <button v-if="pagination.prev_page_url" @click="fetchUsers(pagination.prev_page_url)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Previous</button>
              <button v-if="pagination.next_page_url" @click="fetchUsers(pagination.next_page_url)" class="ml-2 px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Next</button>
            </div>
          </div>
        </div>

        <div v-if="currentTabIndex === 1">
          <div class="mx-auto flex-1 p-3">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      treatment name
                    </th>
                    <th scope="col" class="px-6 py-3">
                      description
                    </th>
                    <th scope="col" class="px-6 py-3">
                      waiting time
                    </th>
                    <th scope="col" class="px-6 py-3">
                      price
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Choose Treatment
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="treatment in treatments" :key="treatment.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ treatment.treatment_name }}
                    </td>
                    <td class="px-6 py-4">
                      {{ treatment.description }}
                    </td>
                    <td class="px-6 py-4">
                      {{ treatment.waiting_time }}
                    </td>
                    <td class="px-6 py-4">
                      {{ treatment.price }}
                    </td>
                    <td class="px-6 py-4">
                      <button @click="chooseTreatment(treatment)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Choose</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="mt-4">
              <button v-if="pagination1.prev_page_url" @click="fetchTreatments(pagination1.prev_page_url)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Previous</button>
              <button v-if="pagination1.next_page_url" @click="fetchTreatments(pagination1.next_page_url)" class="ml-2 px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Next</button>
            </div>
          </div>
        </div>

        <div v-if="currentTabIndex === 2">
            <VueDatePicker v-model="date" :min-date="new Date()" :enable-time-picker="false" />
            <VueDatePicker v-model="time" time-picker />
        </div>

        <div v-if="currentTabIndex === 3">


            <form class="p-10" @submit.prevent="updateUser">
                <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dentist Name</label>
                <input type="email" id="email" v-model="dr.values.first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dentist LastName</label>
                <input type="text" id="name" v-model="dr.values.last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                <label for="procedureName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Procedure Name</label>
                <input type="text" id="procedureName"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                <label for="procedureCost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Procedure Cost</label>
                <input type="number" id="procedureCost"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                <VueDatePicker  />
                </div>
                <div class="mb-6">
                <label for="startTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                <VueDatePicker  time-picker />
                </div>
                <div class="mb-6">
                <label for="endTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                <VueDatePicker  time-picker />
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>



        </div>
      </Wizard>
    </div>
  </div>
</template>
