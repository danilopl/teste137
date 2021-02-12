<template>
  <div class="imagem-card">
    <div class="card" v-if="imagem">
        <img ref="imagem" :src="imagem.data_url" :alt="imagem.name">
        <h2 class="is-size-4 has-text-weight-bold">{{ imagem.name }}</h2>
        <span v-if="imagem.user_name">Postado por: {{ imagem.user_name }}</span>
        <small class="imagem-date">{{ imagem.created_at }}</small>
    </div>
    <div class="card" v-if="file">
        <h2 class="is-size-4 has-text-weight-bold">{{ file.name }}</h2> <br/>
        <span v-if="file.user_name">Postado por: {{ file.user_name }}</span> <br/>
        <small class="imagem-date">{{ file.created_at }}</small> <br/>
        <button @click="$router.go(-1)">Voltar</button>
        <button @click="download(file.id, file.name)">Download</button> <br/>
        <img @click="download(file.id, file.name)" ref="imagem" :alt="file.name">
    </div>
  </div>
</template>
<script>
import axios from 'axios'

function _arrayBufferToBase64( buffer ) {
    var binary = '';
    var bytes = new Uint8Array( buffer );
    var len = bytes.byteLength;
    for (var i = 0; i < len; i++) {
        binary += String.fromCharCode( bytes[ i ] );
    }
    return window.btoa( binary );
}

export default {
  props: [
    'imagem'
  ],
  data () {
    return {
      file: ''
    }    
  },
  methods: {
    download (id, name){
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
          })
    }
  },
  created() {
    if(this.$route.params.id){
      let id = Number(this.$route.params.id);

      axios
          .get('http://backend.local/api/image/'+id)
          .then((response) => {
          
            this.file = response.data.image;
            
            axios
              .get('http://backend.local/api/image/'+id+'/download',{responseType: 'arraybuffer'})
              .then((response) => {
                if(200 == response.status){
                  this.$refs.imagem.src = 'data:image;base64, '+_arrayBufferToBase64(response.data);
                }
              })

          })
    }
  },
}
</script>
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
  margin: 10px;
}
p {
  margin-top: 40px;
  font-size: 13px;
}
p a {
  text-decoration: underline;
  cursor: pointer;
}
img {
  cursor:pointer;
}
</style>