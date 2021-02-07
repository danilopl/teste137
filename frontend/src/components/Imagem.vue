<template>
  <div class="imagem-card">
    <div class="card">
      <div class="card-content">
        <h2 class="is-size-4 has-text-weight-bold">{{ imagem.name }}</h2> <br/>
        <span>Postado por: {{ imagem.user_name }}</span> <br/>
        <small class="imagem-date">{{ imagem.created_at }}</small> <br/>
        <img :src="imagem.path" :alt="imagem.name" :width="300">
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: [
    'imagem'
  ]
}
</script>