<template>
  <b-container>
    <b-row class="mt-5">
      <b-col>
        <h4>Produtos</h4>
      </b-col>
    </b-row>

    <b-row>
      <b-col>
        <b-table class="table" hover striped :fields="campos" :items="produtos"></b-table>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  created() {
    this.getProdutos();
  },

  data() {
    return {
      produtos: [],
      campos: [
        { key: "nome", label: "Nome do produto" },
        { key: "valor", label: "Valor do produto" },
      ],
    };
  },

  methods: {
    getProdutos() {
      this.$http.get("loja/produtos/" + this.$route.params.id).then((res) => {
        if (res.status === 200) {
          if (res.data.response.data) {
            this.produtos = res.data.response.data;
          }
        }
      });
    },
  },
};
</script>
