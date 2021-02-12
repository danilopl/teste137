<template>
    <section class="hero is-primary">
      <div class="container">
        <p>
          Postado por: 
          <select v-model="userNameSelected" @change="filter()">
            <option value="">Selecione um proprietário</option>
            <option v-for="option in optionsNameSelected" v-bind:value="option">
              {{ option }}
            </option>
          </select>
        </p>
        <p>
          Postado em: 
          <input type="date" v-model="data" :min="dataMinMax.min" :max="dataMinMax.max" 
          @change="filter()"/>
        </p>
      </div>
    </section>  
    <section class="imagens-content">
      <div class="container" v-if="imagens.length">
        <div class="imagens-images columns is-multiline has-text-centered">
          <div v-for="imagem in imagens" :key="imagem.id" class="column is-one-third">
            <router-link :to="'/imagem/' + imagem.id">
              <Imagem :imagem="imagem" />
            </router-link>
          </div>
        </div>
      </div>
      <div class="container" v-if="!imagens.length">
          <h2>Nenhuma imagem encontrada</h2>
        </div>
    </section>
</template>
<script>
import Imagem from '@/components/Imagem';
import axios from 'axios'
import search from '@/search'

export default {
  name: 'Imagens',
  components : {
    Imagem
  },
  data () {
    return {
      imagens: [
      ],
      userNameSelected: '',
      optionsNameSelected: '',
      data: '',
      dataMinMax: {min:'',max:''}
    }    
  },
  methods: {
    load () {
      axios
        .get('http://backend.local/api/image')
        .then((response) => {
          search.load(response.data.list);
          this.imagens = search.list();
          this.optionsNameSelected = search.getParamUserName();
        });
    },
    filter(){
      search.reset();
      search.filter('user_name',this.userNameSelected);
      this.dataMinMax = search.createParamCreatedAt();
      search.filterByCreatedAt(this.data);
      this.imagens = search.list();
    },
  },
  created() {
      this.load();
  }
}
</script>
<style scoped>
p {
  font-size: 16px;
  font-weight: bold;
  
}
input, select {
  margin: 10px 0;
  padding: 10px;
}
</style>