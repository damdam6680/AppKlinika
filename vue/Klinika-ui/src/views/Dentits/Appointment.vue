<script>
import navbar from '../navbar.vue';
import sidebar from './DentsiSidebar.vue';
import axios from 'axios';

export default {
  components: {
    navbar,
    sidebar,
  },

  data() {
    return {
      appointments: [],
      pagination: {},
    };
  },

  mounted() {
    this.fetchAppointments('http://127.0.0.1:8000/api/appointments/appointments/doctor');
  },

  methods: {
    fetchAppointments(url) {
      const token = localStorage.getItem('token');

      axios.get(url, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((response) => {
        console.log(response.data); // Wyświetlenie danych w konsoli

        if (response.data && response.data.data && Array.isArray(response.data.data)) {
          this.appointments = response.data.data;
          this.pagination = response.data.links;
        } else {
          console.error("Invalid data format:", response.data);
        }
      })
      .catch((error) => {
        console.error("Failed to fetch appointments:", error);
      });
    },

    fetchUsers(url) {
      this.fetchAppointments(url);
    },

    acceptAppointment(appointment) {
      const token = localStorage.getItem('token');

      axios.patch(`http://127.0.0.1:8000/api/appointments/${appointment.id}`, { isAccepted: 1 }, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((response) => {
        console.log("Appointment accepted:", response.data);

        // Zaktualizowanie wartości isAccepted na 1 w lokalnej kopii danych
        appointment.isAccepted = 1;
      })
      .catch((error) => {
        console.error("Failed to accept appointment:", error);
      });
    },
  },
};
</script>

<template>
  <navbar></navbar>
  <sidebar></sidebar>

  <div class="p-4 sm:ml-64">
    <div class="mx-auto flex-1 p-3">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                Name
              </th>

              <th scope="col" class="px-6 py-3">
                Treatment Name
              </th>
              <th scope="col" class="px-6 py-3">
                Date
              </th>
              <th scope="col" class="px-6 py-3">
                Visit Time
              </th>
              <th scope="col" class="px-6 py-3">
                Visit End
              </th>
              <th scope="col" class="px-6 py-3">
                Status
              </th>
              <th scope="col" class="px-6 py-3">
                Actions
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="appointment in appointments" :key="appointment.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ appointment.patient ? `${appointment.patient.first_name} ${appointment.patient.last_name}` : 'Brak danych pacjenta' }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.treatment ? appointment.treatment.name : 'Brak nazwy zabiegu' }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.visit_date }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.visit_time }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.visit_end }}
              </td>
              <td class="px-6 py-4">
                {{ appointment.Accepted }}
              </td>
              <td class="px-6 py-4">
                <button v-if="!appointment.Accepted" @click="acceptAppointment(appointment)" class="px-3 py-2 text-xs font-medium leading-4 text-white bg-green-600 hover:bg-green-700 rounded-lg">Akcept</button>
                <span v-else class="text-green-600">Accepted</span>
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
</template>
