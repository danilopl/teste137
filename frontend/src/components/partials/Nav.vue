<template>
  <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/perfil">Perfil</router-link> |
    <span v-if="isAdmin">
      <router-link to="/minhas-imagens">Minhas Imagens</router-link> |
    </span>
    <router-link to="/imagens">Lista de Imagens</router-link> |
    <router-link to="/logout">Logout</router-link>  
  </div>
</template>
<script>
import auth from '@/auth'
export default {
  name: 'Nav',
  data () {
    return {
      isAdmin: false
    }    
  },
  methods: {
  },
  created() {
    this.isAdmin=auth.isAdmin();
  }
}
</script>
<style lang="scss" scoped>
  nav {
    margin-top: 25px;
    margin-bottom: 30px;
    a {
      font-weight: bold;
      color: #2c3e50;
      &.router-link-exact-active {
        color: #d88d00;
      }
    }  
  } 
</style>