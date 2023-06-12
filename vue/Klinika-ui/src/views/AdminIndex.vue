<template>


    <div class="">
    <Chart
      :size="chartSize"
      :data="data"
      :margin="margin"
      :direction="direction">

      <template #layers>
        <Grid strokeDasharray="2,2" />
        <Line :dataKeys="['name', 'pl']" />
      </template>

    </Chart></div>
  </template>

  <script lang="ts">
  import { defineComponent, ref } from 'vue'
  import { Chart, Grid, Line } from 'vue3-charts'

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
        top: 20,
        right: 20,
        bottom: 0
      })
      const chartSize = ref({
        width: window.innerWidth,
        height: window.innerHeight
      })

      window.addEventListener('resize', () => {
        chartSize.value.width = window.innerWidth
        chartSize.value.height = window.innerHeight
      })

      return { data, direction, margin, chartSize }
    }
  })
  </script>

  <style>
  #app {
    color: #2ecc71
  }

  </style>
