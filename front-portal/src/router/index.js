import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import PrivateLayoutVue from '@/layouts/PrivateLayout.vue'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { authRoutes } from './../modules/auth/routes/index';
import { candidatesRoutes } from './../modules/portal/routes/index';

const routes = [

  {
    path: '/',
    component: PrivateLayoutVue,
    // beforeEnter: [ isAuthenticatedGuard ],
    children: [
      {
        path: '',
        component: HomeView,
        meta: { title: 'Home' }
      },
      ...candidatesRoutes,
      // {
      //   path: '/home',
      //   component: HomeView,
      //   meta: { title: 'Home' }
      // }
    ]
  },
  {
    path: '/auth',
    component: AuthLayout,
    children: [
      // {
      //   path: 'login',
      //   name: 'auth-signin',
      //   component: AboutView,
      //   meta: { title: 'Auth' }
      // }
      ...authRoutes
    ]
  },
]

const router = createRouter({
  // history: createWebHistory(process.env.BASE_URL),
  history: createWebHistory(),
  routes
})

export default router
