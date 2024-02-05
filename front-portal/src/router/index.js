import { createRouter, createWebHistory } from 'vue-router'
import PrivateLayoutVue from '@/layouts/PrivateLayout.vue'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { authRoutes } from './../modules/auth/routes/index';
import { candidatesRoutes } from './../modules/portal/routes/index';
import { isAuthenticatedGuard } from './auth-guard';

const routes = [

  {
    path: '/',
    component: PrivateLayoutVue,
    beforeEnter: [ isAuthenticatedGuard ],
    children: [

      ...candidatesRoutes,
    ]
  },
  {
    path: '/auth',
    component: AuthLayout,
    children: [
      ...authRoutes
    ]
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
