
<!-- dodac wybór czasu i przyciki do tabel -->
<script>
import 'form-wizard-vue3/dist/form-wizard-vue3.css';
import Wizard from 'form-wizard-vue3';
import navbar from '../navbar.vue';
import { onMounted } from "vue";
import { Datepicker, Input, initTE } from "tw-elements";

  onMounted(() => {
    initTE({ Datepicker, Input });
  });
const selectedDentist = ref({});
const selectedTreatment = ref({});

export default {
  name: 'App',
  data() {
    return {
      currentTabIndex: 0,
      selectedDate: '',
      selectedTime: '',
      selectedTreatmentDate: '',
      formattedTime:'',
      appointmentDescription: '',
      errorMessage: '',
    };
  },
  components: {
    Wizard,
    navbar,
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

        const appointmentData = {
            dentist_id: selectedDentist.value.id,
            treatmets_id: selectedTreatment.value.id,
            visit_date: this.selectedDate,
            visit_time: this.selectedTime,
            visit_end: this.formattedTime,
            description: this.appointmentDescription,
            price: selectedTreatment.value.price,
  };


  console.log(appointmentData.dentist_id);
  console.log(appointmentData.treatmets_id);
  console.log(appointmentData.visit_date);
  console.log(appointmentData.visit_time);
  console.log(appointmentData.visit_end);
  console.log(appointmentData.description);
  console.log(appointmentData.price);

  const token = localStorage.getItem('token');
  const config = {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  };

  axios
    .post('http://127.0.0.1:8000/api/appointments', appointmentData, config)
    .then((response) => {
      // Obsłuż odpowiedź
      console.log(response.data);
    })
    .catch((error) => {
      // Obsłuż błąd
      console.error(error);
      if (error.response && error.response.status !== 200) {
      const errorMessage = error.response.data.message;
      // Wyświetl komunikat błędu nad formularzem
      document.getElementById('error-message').textContent = errorMessage;
    }
    });


    },
    chooseDentist(dentistId) {
                // Assign the selected dentist directly to the property
        selectedDentist.value = dentistId;

        // Display the selected dentist in the console
        console.log(selectedDentist);
    },
    chooseTreatment(treatmentId) {
      // Zapisz wybór użytkownika w zmiennej
      selectedTreatment.value = treatmentId;

      // Wyświetl powiadomienie
      console.log(treatmentId);
    },
    addAppointment() {
        const selectedDateTime = new Date(`${this.selectedDate}T${this.selectedTime}:00`);

         this.selectedTreatmentDate= new Date(`${this.selectedDate}T${selectedTreatment.value.waiting_time}`);

        this.selectedTreatmentDate.setHours(this.selectedTreatmentDate.getHours() + selectedDateTime.getHours());
        this.selectedTreatmentDate.setMinutes(this.selectedTreatmentDate.getMinutes() + selectedDateTime.getMinutes());
        this.selectedTreatmentDate.setSeconds(this.selectedTreatmentDate.getSeconds() + selectedDateTime.getSeconds());

        this.formattedTime = this.selectedTreatmentDate.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit' });

        console.log( this.formattedTime);
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


const users = ref([]);
const emails = ref({});
const pagination = ref({});
const treatments = ref([]);
const pagination1 = ref({});

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
    fetchUsers('http://127.0.0.1:8000/api/dentists');
    fetchTreatments('http://127.0.0.1:8000/api/treatments');

});


</script>




<style>
body{
    background-color:  #7889fc;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #000000;
  background-color:  #7889fc;
    height: 100%;
}
.fw-body {
    background-color: #7889fc;

}
.fw-body-content{
    max-width:85%;
}
.fw-body-list{
    background-color: #7889fc;
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
#body{
    color: black;
}
</style>

<template>
  <navbar></navbar>
  <div id="app">
    <div>
      <Wizard


        navigable-tabs
        vertical-tabs
        :nextButton="nextButtonOptions"
        :custom-tabs="[
          {
            title: 'Choose doctor',
            index: 0,
          },
          {
            title: 'Choose treatments',
            index: 1,
          },
          {
            title: 'Choose Date',
            index: 2,
          },
          {
            title: 'Summary',
            index: 3,
          }
        ]"
        :beforeChange="onTabBeforeChange"
        @change="onChangeCurrentTab"
        @complete:wizard="wizardCompleted"
      >
      <div v-if="currentTabIndex === 0">
          <div class="mx-auto flex-1 p-3 max-w-screen-2xl">
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
          <div class="mx-auto flex-1 max-w-screen-2xl">
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
            <input type="date" id="selectedDate" v-model="selectedDate" name="selectedDate" />
            <input type="time" id="selectedTime" v-model="selectedTime" name="selectedTime" />
            <button @click="addAppointment" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Dodaj</button>
        </div>

        <div v-if="currentTabIndex === 3">
            <div class="mb-6">
                <div id="error-message" class="bg-red-400 rounded-lg p-2"></div>
              </div>

              <form class="p-10 " @submit.prevent="updateUser">
                <div class="grid grid-cols-2 gap-4 ">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dentist Name</label>
                        <input type="text" id="name" v-model="selectedDentist.first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                    </div>

                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dentist LastName</label>
                        <input type="text" id="name" v-model="selectedDentist.last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                    </div>
                </div>
                <div class="mb-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 pt-5 dark:text-white">Treatment Name</label>
                        <input type="text" id="name" v-model="selectedTreatment.treatment_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                    </div>
                </div>
                <div class="mb-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900  dark:text-white">price</label>
                        <input type="text" id="name" v-model="selectedTreatment.price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                    </div>
                </div>
                <div class="mb-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 0 dark:text-white">Date</label>
                        <input type="text" id="name" v-model="selectedDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                    </div>
                </div>
                <div class="mb-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900  dark:text-white">Start Time</label>
                        <input type="text" id="name" v-model="selectedTime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                    </div>
                </div>
                <div class="mb-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900  dark:text-white">End Time</label>
                        <input type="text" id="name" v-model="formattedTime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                    </div>
                </div>
                <div class="mb-6">
                    <div>
                        <label for="description" class="mb-2 text-sm font-medium text-gray-900  dark:text-white">Opis</label>
                        <textarea id="description" v-model="appointmentDescription" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" ></textarea>
                    </div>
                </div>
            </form>




        </div>
      </Wizard>
    </div>
  </div>
</template>
