<template>
  <Imagem :imagem="imagem" />
</template>
<script>
import Imagem from '@/components/Imagem';
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
  name: 'ShowImage',
  components : {
    Imagem
  },
  data () {
    return {
      imagem : {}   
    }
  },
  // created() {
  //   const ID = Number(this.$route.params.id);
  //   let imagem = this.imagens.find(imagem => imagem.id === ID);
  //   this.imagem = imagem;
  // },
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
                  this.file.data_url = 'data:image;base64, '+_arrayBufferToBase64(response.data);
                }
              })

          })
    }
  },
  updated: function () {
    this.$nextTick(function () {
      const ID = Number(this.$route.params.id);
      let imagem = this.imagens.find(imagem => imagem.id === ID);
      this.imagem = imagem;
    })
  }
}
</script>