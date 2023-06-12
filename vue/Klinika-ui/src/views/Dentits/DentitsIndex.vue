<template>
    <navbar></navbar>
    <sidebar></sidebar>


    <div class="p-4 sm:ml-64">
        <Qalendar :events="events" />
    </div>


  </template>

  <script>
   import { Qalendar } from "qalendar";
  import axios from "axios";

  export default {
    components: {
      Qalendar,
    },

    data() {
      return {
        events: [],
      };
    },

    mounted() {
      this.fetchAppointments();
    },

    methods: {
      fetchAppointments() {
        const token = localStorage.getItem('token');

        axios
          .get("http://127.0.0.1:8000/api/appointments/calendar", {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          })
          .then((response) => {
            console.log(response.data); // Wyświetlenie danych w konsoli

            if (response.data && Array.isArray(response.data)) {
              this.events = response.data.map((appointment) => {
                let color = appointment.isAccepted === 1 ? 'green' : 'red';

                return {
                  title: appointment.treatment ? appointment.treatment.treatment_name : 'Brak nazwy zabiegu',
                  with: appointment.patient ? `${appointment.patient.first_name} ${appointment.patient.last_name}` : 'Brak danych pacjenta',
                  time: {
                    start: this.formatDateTime(appointment.visit_date, appointment.visit_time),
                    end: this.formatDateTime(appointment.visit_date, appointment.visit_end),
                  },
                  color: color,
                  isEditable: false,
                  id: appointment.id.toString(),
                  description: appointment.description,
                };
              });
            } else {
              console.error("Invalid data format:", response.data);
            }
          })
          .catch((error) => {
            console.error("Failed to fetch appointments:", error);
          });
      },

      formatDateTime(date, time) {
        const [year, month, day] = date.split("-");
        const [hour, minute, second] = time.split(":");
        return `${year}-${month}-${day} ${hour}:${minute}`;
      },
    },
  };
  </script>
    <script setup>
          import navbar from '../navbar.vue';
          import sidebar from './DentsiSidebar.vue';
    </script>
  <style>
  @import "qalendar/dist/style.css";
  </style>
