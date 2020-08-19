<template>
  <div>
    <b-link :to="{name: 'produtos_loja', params: {id: loja.id_loja}}">
      <b-card class="card">
        <b-card-title>{{loja.nome_loja}}</b-card-title>
        <b-card-text>{{loja.email}}</b-card-text>
      </b-card>
    </b-link>
  </div>
</template>

<script>
export default {
    props: ['loja'],
};
</script>

<style scoped>
    .card {
        width: 250px;
    }
</style>
