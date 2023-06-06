
<!-- dodac wybór czasu i przyciki do tabel -->
<script>
import 'form-wizard-vue3/dist/form-wizard-vue3.css';
import Wizard from 'form-wizard-vue3';
import navbar from '../navbar.vue';

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
  },
  computed: {
    nextButtonOptions() {
      return this.currentTabIndex === 2
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
import { ref, onMounted } from 'vue';
import axios from 'axios';


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
  <div id="app" >
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
                      <th scope="col" class="px-6 py-3">
                        Choose Dentist
                        </th>

                    </tr>
                  </thead>
                  <tbody>
                      <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        </td>
                        <td class="px-6 py-4">
                          {{ user.description }}
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
                                choose
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


                          </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="mt-4">
                    <button v-if="pagination1.prev_page_url" @click="fetchUsers(pagination1.prev_page_url)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Previous</button>
                    <button v-if="pagination1.next_page_url" @click="fetchUsers(pagination1.next_page_url)" class="ml-2 px-3 py-2 text-xs font-medium leading-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Next</button>
                  </div>
                </div>



        </div>
        <div v-if="currentTabIndex === 2">Tab 0</div>
      </Wizard>
    </div>
  </div>
</template>
