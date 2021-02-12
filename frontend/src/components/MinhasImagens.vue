<template>
  <div class="minhas-imagens">
    <section class="hero is-primary">
      <div class="container">
        <p>
          Seleciona uma imagem:
          <input type="file" id="file" ref="file" />
        </p>
        <button v-on:click="upload()">Upload</button>
      </div>
    </section> 
    <div class="imagens" v-if="profile.images" >
      <div class="container">
        <div class="imagens-images columns is-multiline has-text-centered">
          <div v-for="imagem in profile.images" :key="imagem.id" class="column is-one-third">
            <router-link :to="'/imagem/' + imagem.id">
              <Imagem :imagem="imagem" />
            </router-link>
            <button @click="downloadD(imagem.id, imagem.name)">Download</button>&nbsp;
            <button @click="excluir(imagem.id)">Excluir</button>
          </div>
        </div>
      </div>
    </div>
    <div class="imagens" v-if="!profile.images" >
        <h2 class="subtitle ">
          Não existe imagens postadas
        </h2>
    </div>
  </div>
</template>
<script>
import Imagem from '@/components/Imagem';
import axios from 'axios'


export default {
  name: 'Perfil',
  components : {
    Imagem
  },
  data () {
    return {
      profile: {},
      file: ''
    }    
  },
  methods: {
    loadImagens () {
        axios
        .get('http://backend.local/api/user/image')
        .then((response) => {
          this.profile = response.data;
        });
    },
    upload (){
      this.file = this.$refs.file.files[0];
      
      let formData = new FormData();
      formData.append("file", this.file);
      axios
        .post('http://backend.local/api/image', formData)
        .then((response) => {
          this.loadImagens();
          this.$refs.file.value = '';
        });
    },
    excluir (id){
      axios
          .delete('http://backend.local/api/image/'+id)
          .then((response) => {
            if(200 == response.status){
              this.loadImagens();
            }
          });
    },
    downloadD (id, name){
        axios
          .get('http://backend.local/api/image/'+id+'/download',{responseType: 'arraybuffer'})
          .then((response) => {
            if(200 == response.status){
              const url = window.URL.createObjectURL(new Blob([response.data]))
              const link = document.createElement('a')
              link.href = url
              link.setAttribute('download', name)
              document.body.appendChild(link)
              link.click()
            }
          });
    }
  },
  created() {
      this.loadImagens();
  },
  updated: function () {
    this.$nextTick(function () {
    })
  }
}
</script>;
<style scoped>
button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4caf50;
  border: 0;
  padding: 15px;
  color: #ffffff;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  margin: 10px 0 10px;
}
p {
  font-size: 16px;
  font-weight: bold;
  
}
input, select {
  margin: 10px 0;
  padding: 10px;
}
</style>