import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

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
      path: '/PatientIndex',
      name: 'PatientIndex',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/PatientIndex.vue')
    },
    {
      path: '/AdminIndex',
      name: 'AdminIndex',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AdminIndex.vue')
    },
    {
        path: '/ShowDentists',
        name: 'ShowDentists',
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowDentists.vue')
      },
    {
        path: '/ShowUsers',
        name: 'ShowUsers',
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowUsers.vue')
      },
      {
        path: '/EditUsers/:userId',

        name: 'EditUsers',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditUsers.vue'),

      },
      {
        path: '/EditDentists/:userId',
        name: 'EditDentists',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditDentists.vue')
      },
      {
        path: '/EditPatientsData',
        name: 'EditPatientsData',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/EditPatientsData.vue')
      },
      {
        path: '/MakeApoitment',
        name: 'MakeApoitment',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/MakeApoitment.vue')
      },
      {
        path: '/DentitsIndex',
        name: 'DentitsIndex',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/DentitsIndex.vue')
      },
      {
        path: '/Appotemnts',
        name: 'Appotemnts',

        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/Appotemnts.vue')
      }
  ]
})

export default router
