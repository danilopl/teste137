<template>
<div class="hello">
  <h1>TESTE PRÁTICO – ANALISTA DE SISTEMAS BACK END (PHP)</h1>
  <h3>Profile</h3>
  <ul>
    <li>
      <router-link to="/profile/1">
        Admininstrador
      </router-link>
    </li>
    <li>
      <router-link to="/profile/2">
        Usuario
      </router-link>  
    </li>
  </ul>
  <h3>Imagens</h3>
  <ul>
    <li v-for="imagem in imagens" :key="imagem.id">
      <router-link :to="'/imagem/' + imagem.id">
        {{imagem.name}}
      </router-link>
    </li>
    <li>
      <router-link to="/imagens">
        Lista
      </router-link>
    </li>
  </ul>
    <h3>Lista</h3>
    <ul>
      <li><a href="https://router.vuejs.org" target="_blank" rel="noopener">vue-router</a></li>
      <li><a href="https://vuex.vuejs.org" target="_blank" rel="noopener">vuex</a></li>
      <li><a href="https://github.com/vuejs/vue-devtools#vue-devtools" target="_blank" rel="noopener">vue-devtools</a></li>
      <li><a href="https://vue-loader.vuejs.org" target="_blank" rel="noopener">vue-loader</a></li>
      <li><a href="https://github.com/vuejs/awesome-vue" target="_blank" rel="noopener">awesome-vue</a></li>
    </ul>
</div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      imagens: [
         {
          id: 1,
          name: "Congresso Nacional",
        },
        {
          id: 2,
          name: "Catedral",
        },
        {
          id: 3,
          name: "Leão",
        }
      ]
    }    
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>