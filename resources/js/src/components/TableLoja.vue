<template>
  <div>
    <Erro :mensagem="mensagem" :codigo="codigo" v-if="feedback" />
    <b-overlay :show="loading">
      <b-table striped hover :items="lojas" :fields="campos" class="mt-2">
        <template v-slot:cell(editar)="row">
          <b-button size="sm" @click="row.item" variant="info">
            <b-icon variant="light" icon="pen"></b-icon>
          </b-button>
        </template>

        <template v-slot:cell(remover)="row">
          <b-button size="sm" @click="removerLoja(row.item.id_loja)" variant="danger">
            <b-icon variant="light" icon="trash"></b-icon>
          </b-button>
        </template>
      </b-table>
    </b-overlay>
    <div>
      <b-pagination align="center"></b-pagination>
    </div>
  </div>
</template>

<script>
import Erro from "./Erro";
export default {
  components: { Erro },
  created() {
    this.$store.dispatch("lojas");
  },

  computed: {
    lojas: function () {
      return this.$store.getters.lojas;
    },
  },

  data() {
    return {
      loading: false,
      feedback: false,
      mensagem: "",
      codigo: "",
      campos: [
        { key: "nome_loja", label: "Nome da Loja", sortable: true },
        { key: "email", label: "Email da Loja", sortable: true },
        { key: "editar", label: "" },
        { key: "remover", label: "" },
      ],
    };
  },

  methods: {
    removerLoja(id) {
      this.feedback = false;
      if (confirm("Deseja remover?")) {
        axios.delete("lojas/" + id).then((res) => {
          this.loading = false;
          if (res.status == 200) {
            this.feedback = true;
            if (res.data.response.data) {
              this.$store.dispatch("lojas");
              this.mensagem = "Item removido com sucesso!";
              this.codigo = res.data.response.cod;
            } else {
              this.mensagem = res.data.response.mensagem;
              this.codigo = res.data.response.cod;
            }
          }
        });
      }
      this.loading = false;
    },
  },
};
</script>

<style scoped>
</style>
