<template>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidenav">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <ul class="space-y-2">
            <li>
                <a href="/admin/home" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Overview</span>
                </a>
            </li>
            <li>
                    <a href="/show/users" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                        <span class="ml-3">Users</span>
                    </a>
            </li>
            <li>
                <a href="/show/patients" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Patients</span>
                </a>
            </li>
            <li>
                <a href="/ShowDentists" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Doctors</span>
                </a>
            </li>
            <li>
                <a href="/show/appointments" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Apotments</span>
                </a>
            </li>
            <li>
                <a href="/add/dentis" class="flex items-center p-2 text-base font-normal text-gray-900 bg-blue-500 rounded-lg dark:text-white hover:bg-green-500 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true" class="w-6 h-6 text-sky-500  transition duration-75 dark:text-gray-400   group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Add Dentist</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="hidden absolute bottom-0 left-0 justify-center space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20 border-r border-gray-200 dark:border-gray-700">
        <button  id="logoutButton" class="flex items-center p-2 text-base font-normal text-gray-900 bg-red-800 rounded-lg dark:text-white hover:bg-green-900 dark:hover:bg-gray-700 group">
            <span class="ml-3">Loggout</span>
        </button>
        <!-- Dropdown -->

    </div>
    </aside>

    <div class="p-4 sm:ml-64">
    <Chart
    :size="chartSize"
    :data="data"
    :margin="margin"
    :direction="direction">

    <template #layers>
      <Grid strokeDasharray="2,2" />
      <Line :dataKeys="['name', 'pl']" />
    </template>

  </Chart>
</div>

  </template>

  <script  lang="ts">
  import { defineComponent, ref } from 'vue'
  import { Chart, Grid, Line } from 'vue3-charts'
  import { initFlowbite } from 'flowbite'



    initFlowbite()

  const plByMonth = [
    { name: 'Jan', pl: 100 },
    { name: 'Feb', pl: 200 },
    { name: 'Mar', pl: 150 },
    { name: 'Apr', pl: 300 },
    { name: 'May', pl: 250 },
    { name: 'Jun', pl: 180 },
    { name: 'Jul', pl: 220 },
    { name: 'Aug', pl: 150 },
    { name: 'Sep', pl: 280 },
    { name: 'Oct', pl: 200 },
    { name: 'Nov', pl: 320 },
    { name: 'Dec', pl: 250 }
  ]

  export default defineComponent({
    name: 'LineChart',
    components: { Chart, Grid, Line },
    setup() {
      const data = ref(plByMonth)
      const direction = ref('horizontal')
      const margin = ref({
        left: 0,
        top: 0,
        right: 0,
        bottom: 0
      })
      const chartSize = ref({
        width: window.innerWidth * 0.80,
        height: window.innerHeight * 0.95
      })

    //   window.addEventListener('resize', () => {
    //     chartSize.value.width = window.innerWidth
    //     chartSize.value.height = window.innerHeight
    //   })

      return { data, direction, margin, chartSize }
    }
  })
  </script>



  <style>
  #app {
    color: #2ecc71
  }

  </style>
