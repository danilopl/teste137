import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import auth from '@/auth'

const routes = [
  {
    path: '/',
    name: 'login',
    component: () => import('@/views/Login.vue')
  },
  {
    path: '/imagens',
    name: 'imagens',
    component: () => import('@/components/Imagens.vue')
  },
  {
    path: '/imagem/:id',
    name: 'showImagem',
    component: () => import('@/components/ShowImagem.vue')
  },
  {
    path: '/perfil',
    name: 'perfil',
    component: () => import('@/components/Perfil.vue'),
    meta: {
      authenticathed: true
    }
  },
  {
    path: '/profile/:id',
    name: 'profile',
    component: () => import('@/components/Profile.vue')
  },
  {
    path: '/registrar',
    name: 'registrar',
    component: () => import('@/views/SingUp.vue')
  },
  {
    path: '/minhas-imagens',
    name: 'minhas-imagens',
    component: () => import('@/components/MinhasImagens.vue'),
    meta: {
      authenticathed: true,
      isAdmin: true,
      scopes: ['administrator']
    }
  },
  {
    path: '/logout',
    name: 'logout',
    component: () => import('@/components/Logout.vue'),
    meta: {
      authenticathed: true,
    }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  const authorization = localStorage.getItem('authorization');
  const authenticathed = to.matched.some(record => {return record.meta.authenticathed;});
  const isAdmin = to.matched.some(record => {return record.meta.isAdmin;});

  if (authenticathed && !authorization) next('login');
  else if (authenticathed && authorization && isAdmin && !auth.isAdmin()) next('login');
  else next();
});

export default router
