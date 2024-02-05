
export const authRoutes = [
  {
    path: 'login',
    name: 'login',
    component: () => import('./../pages/LoginPage.vue')
  },
  {
    path: 'register',
    name: 'register',
    component: () => import('./../pages/RegisterPage.vue')
  },
  ]