<template>
  <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/profile/1">Perfil</router-link> |
    <router-link to="/imagem/3">Imagem</router-link> |
    <router-link to="/imagens">Lista de Imagens</router-link> |
  </div>
</template>
<script>
export default {
  name: 'Nav',
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