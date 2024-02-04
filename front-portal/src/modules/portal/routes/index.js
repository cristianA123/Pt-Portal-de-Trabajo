
export const candidatesRoutes = [
  {
    path: 'candidates',
    name: 'candidates',
    component: () => import('./../pages/CandidatePage.vue')
  },
  {
    path: 'jobs',
    name: 'jobs',
    component: () => import('./../pages/JobPage.vue')
  },
]