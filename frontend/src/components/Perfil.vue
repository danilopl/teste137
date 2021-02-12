<template>
  <div class="sign-up" v-if="isEditar">
    <p>Atualizar Perfil</p>
    <input
      type="text"
      placeholder="Nome"
      v-model="nome"
    >
    <br>
    <input
      type="password"
      placeholder="Senha"
      v-model="senha"
    >
    <br>
    <input
      type="password"
      placeholder="Confirmar Senha"
      v-model="confirmar"
    >
    <br>
    <button @click="update">Atualizar Perfil</button>&nbsp;
    <button @click="toggle">Cancelar</button>
  </div>
  <div class="profile-single" v-if="!isEditar">
    <section class="hero is-primary">
      <div class="container">
        <h1 class="title">
          {{ user.name }}
        </h1>
        <h2 class="subtitle ">
          <strong>E-mail:</strong> {{ user.email }}<br>
          <strong v-if="user.administrador == 1" >Administrador</strong>
        </h2>
        <button @click="toggle">Editar</button>
      </div>
    </section> 
  </div>
</template>
<script>
import Imagem from '@/components/Imagem';
import axios from 'axios'
import auth from '@/auth'

export default {
  name: 'Perfil',
  data () {
    return {
      isEditar: false,
      user: '',
      nome: '',
      senha: '',
      confirmar: '',
    }    
  },
  methods: {
    toggle (){
      this.isEditar = !this.isEditar;
      this.nome = this.user.name;
    },
    update () {
      axios
        .post('http://backend.local/api/user/update', {name : this.nome, password : this.senha, password_confirmation : this.confirmar})
        .then((response) => {
          if(response){
            auth.updateUser();
            setTimeout(() => {
              this.user = auth.getUser();  
              this.toggle();
            },500);  
          }
        });
    }
  },
  created() {
      this.user = auth.getUser();
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
  margin: 5px 0;
}
p {
  font-size: 16px;
  font-weight: bold;
  
}
input, select {
  margin: 5px 0;
  padding: 10px;
}
</style>