import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import axios from 'axios';
import { ref } from 'vue';
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
      meta: {
        requiresUser: true // Dodajemy metadane dla ścieżki wymagającej roli admina
      },
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
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowDentists.vue')
      },
    {
        path: '/show/users',
        name: 'ShowUsers',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowUsers.vue')
      },
      {
        path: '/users/edit/:userId',

        name: 'EditUsers',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditUsers.vue'),

      },
      {
        path: '/edit/dentists/:userId',
        name: 'EditDentists',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditDentists.vue')
      },
      {
        path: '/edit/patients/data',
        name: 'EditPatientsData',
        meta: {
            requiresDentist: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/EditPatientsData.vue')
      },
      {
        path: '/apoitment',
        name: 'MakeAppointment',
        meta: {
            requiresUser: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/MakeAppointment.vue')
      },
      {
        path: '/dentits/home',
        name: 'DentitsIndex',
        meta: {
            requiresDentist: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/DentitsIndex.vue')
      },
      {
        path: '/appointment',
        name: 'appointment',
        meta: {
            requiresDentist: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/Appointment.vue')
      },
      {
        path: '/show/appointments',
        name: 'ShowAppointment',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowAppointment.vue')
      },
      {
        path: '/add/dentis',
        name: 'AddDentis',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/AddDentis.vue')
      },
      {
        path: '/edit/dentist',
        name: 'EditDentist',
        meta: {
            requiresDentist: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Dentits/EditDentist.vue')
      },
      {
        path: '/show/patients',
        name: 'ShowPatients',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowPatients.vue')
      },
      {
        path: '/edit/patients/:userId',
        name: 'EditPatients',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditPatients.vue')
      },
      {
        path: '/show/tretments',
        name: 'ShowTretments',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/ShowTretments.vue')
      },
      {
        path: '/edit/treatments/:userId',
        name: 'EditTreatments',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/EditTreatments.vue')
      },
      {
        path: '/add/treatments',
        name: 'AddTreatments',
        meta: {
            requiresAdmin: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/Admin/AddTreatments.vue')
      },
      {
        path: '/show/appointment/patient',
        name: 'ShowAppotmentsForPatient',
        meta: {
            requiresUser: true // Dodajemy metadane dla ścieżki wymagającej roli admina
          },
        // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/User/ShowAppointmentsForPatient.vue')
      }
  ]
});


const checkUserRole = async (to, from, next) => {
    try {
      const token = localStorage.getItem('token');
      const response = await axios.get('http://127.0.0.1:8000/api/users/me', {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      const user = response.data;
      console.log(user);
      // Sprawdzanie roli użytkownika
      if (user.role === 'admin') {
        // Jeśli użytkownik ma rolę admina, przekieruj do docelowej trasy, np. next('/admin');
        next();
      } else {
        // Jeśli użytkownik nie ma roli admina, przekieruj na stronę główną
        next('/');
      }
    } catch (error) {
      // W przypadku błędu zapytania, przekieruj na stronę logowania
      next('/login');
    }
  };

  const checkDentistRole = async (to, from, next) => {
    try {
      const token = localStorage.getItem('token');
      const response = await axios.get('http://127.0.0.1:8000/api/users/me', {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      const user = response.data;
      console.log(user);
      // Sprawdzanie roli użytkownika
      if (user.role === 'dentist') {
        // Jeśli użytkownik ma rolę dentysty, przekieruj do docelowej trasy, np. next('/dentist');
        next();
      } else {
        // Jeśli użytkownik nie ma roli dentysty, przekieruj na stronę główną
        next('/');
      }
    } catch (error) {
      // W przypadku błędu zapytania, przekieruj na stronę logowania
      next('/login');
    }
  };

  const checkPatientRole = async (to, from, next) => {
    try {
      const token = localStorage.getItem('token');
      const response = await axios.get('http://127.0.0.1:8000/api/users/me', {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      const user = response.data;
      console.log(user);
      // Sprawdzanie roli użytkownika
      if (user.role === 'user') {
        // Jeśli użytkownik ma rolę usera, przekieruj do docelowej trasy, np. next('/user');
        next();
      } else {
        // Jeśli użytkownik nie ma roli usera, przekieruj na stronę główną
        next('/');
      }
    } catch (error) {
      // W przypadku błędu zapytania, przekieruj na stronę logowania
      next('/login');
    }
  };

  router.beforeEach(async (to, from, next) => {
    // Sprawdzanie czy użytkownik jest zalogowany
    const isLoggedIn = true; // Zmień na odpowiednie sprawdzenie czy użytkownik jest zalogowany

    if (to.meta.requiresAdmin) {
      // Sprawdzanie wymaganej roli dla danej trasy
      if (isLoggedIn) {
        // Sprawdzanie roli użytkownika tylko jeśli jest zalogowany
        await checkUserRole(to, from, next);
      } else {
        // Jeśli użytkownik nie jest zalogowany, przekieruj na stronę logowania
        next('/login');
      }
    } else if (to.meta.requiresDentist) {
      // Sprawdzanie wymaganej roli dla danej trasy
      if (isLoggedIn) {
        // Sprawdzanie roli użytkownika tylko jeśli jest zalogowany
        await checkDentistRole(to, from, next);
      } else {
        // Jeśli użytkownik nie jest zalogowany, przekieruj na stronę logowania
        next('/login');
      }
    } else if (to.meta.requiresUser) {
      // Sprawdzanie wymaganej roli dla danej trasy
      if (isLoggedIn) {
        // Sprawdzanie roli użytkownika tylko jeśli jest zalogowany
        await checkPatientRole(to, from, next);
      } else {
        // Jeśli użytkownik nie jest zalogowany, przekieruj na stronę logowania
        next('/login');
      }
    } else {
      // Kontynuuj normalnie, jeśli trasa nie wymaga żadnej konkretnej roli
      next();
    }
  });

  export default router;
