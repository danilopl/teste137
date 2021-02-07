import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/imagens',
    name: 'Imagens',
    component: () => import('@/views/Imagens.vue')
  },
  {
    path: '/imagem/:id',
    name: 'ShowImagem',
    component: () => import('@/components/ShowImagem.vue')
  },
  {
    path: '/profile/:id',
    name: 'Profile',
    component: () => import('@/components/Profile.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
