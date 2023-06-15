import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import axios from 'axios';
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/register',
      name: 'register',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/auth/RegisterIndex.vue')
    },
    {
      path: '/login',
      name: 'login',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/auth/LoginIndex.vue')
    },
    {
      path: '/patient/home',
      name: 'PatientIndex',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/PatientIndex.vue')
    },
    {
      path: '/admin/home',
      name: 'AdminIndex',
      meta: {
        requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
      },
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AdminIndex.vue')

    },
    {
        path: '/show/dentists',
        name: 'ShowDentists',
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowDentists.vue')
      },
    {
        path: '/show/users',
        name: 'ShowUsers',
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowUsers.vue')
      },
      {
        path: '/users/edit/:userId',

        name: 'EditUsers',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditUsers.vue'),

      },
      {
        path: '/edit/dentists/:userId',
        name: 'EditDentists',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditDentists.vue')
      },
      {
        path: '/edit/patients/data',
        name: 'EditPatientsData',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/EditPatientsData.vue')
      },
      {
        path: '/apoitment',
        name: 'MakeAppointment',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/MakeAppointment.vue')
      },
      {
        path: '/dentits/home',
        name: 'DentitsIndex',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/DentitsIndex.vue')
      },
      {
        path: '/appointment',
        name: 'appointment',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/Appointment.vue')
      },
      {
        path: '/show/appointments',
        name: 'ShowAppointment',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowAppointment.vue')
      },
      {
        path: '/add/dentis',
        name: 'AddDentis',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/AddDentis.vue')
      },
      {
        path: '/edit/dentist',
        name: 'EditDentist',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/EditDentist.vue')
      },
      {
        path: '/show/patients',
        name: 'ShowPatients',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowPatients.vue')
      },
      {
        path: '/edit/patients/:userId',
        name: 'EditPatients',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditPatients.vue')
      },
      {
        path: '/show/tretments',
        name: 'ShowTretments',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowTretments.vue')
      },
      {
        path: '/edit/treatments/:userId',
        name: 'EditTreatments',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditTreatments.vue')
      },
      {
        path: '/add/treatments',
        name: 'AddTreatments',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/AddTreatments.vue')
      },
      {
        path: '/show/appointment/patient',
        name: 'ShowAppotmentsForPatient',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/ShowAppointmentsForPatient.vue')
      }
  ]
});

router.beforeEach((to, from) => {
    // ...
    // explicitly return false to cancel the navigation
    return false
  })

export default router
