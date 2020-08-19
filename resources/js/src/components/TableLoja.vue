<template>
  <div>
    <Erro :mensagem="mensagem" :codigo="codigo" v-if="feedback" />
    <b-overlay :show="loading">
      <b-table striped hover :items="lojas" :fields="campos" class="mt-2">
        <template v-slot:cell(show_details)="row" hover striped>
          <b-button variant="info" size="sm" @click="row.toggleDetails" class="mr-2">
            <b-icon icon="pen" />
          </b-button>
        </template>

        <template v-slot:cell(remover)="row">
          <b-button size="sm" @click="removerLoja(row.item.id_loja)" variant="danger">
            <b-icon variant="light" icon="trash"></b-icon>
          </b-button>
        </template>

        <template v-slot:row-details="row">
          <div class="edit_form">
            <b-overlay :v-show="loading">
              <b-form inline>
                <b-input :placeholder="row.item.nome_loja" v-model="form.nome"></b-input>
                <b-input class="ml-3" :placeholder="row.item.email" v-model="form.email"></b-input>
                <b-button
                  class="ml-2"
                  variant="success"
                  @click="editarCampo(row.item.id_loja)"
                >Alterar</b-button>
              </b-form>
            </b-overlay>
          </div>
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
      form: {
        nome: "",
        email: "",
      },
      campos: [
        { key: "nome_loja", label: "Nome da Loja", sortable: true },
        { key: "email", label: "Email da Loja", sortable: true },
        { key: "show_details", label: "" },
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
    editarCampo(id) {
      if (confirm("Deseja prosseguir?")) {
        this.$http
          .put("lojas/" + id, {
            nome_loja: this.form.nome,
            email: this.form.email,
          })
          .then((res) => {
            this.loading = false;
            if (res.status === 200) {
              this.feedback = true;
              if (res.data.response.data) {
                this.$store.dispatch("lojas");
                this.mensagem = "Item alterado com sucesso!";
                this.codigo = res.data.response.cod;
              } else {
                this.mensagem = res.data.response.mensagem;
                this.codigo = res.data.response.cod;
              }
            }
          })
          .catch((err) => {
            this.loading = false;
            console.log(err);
          });
      }
    },
  },
};
</script>

<style scoped>
.edit_form {
  background-color: #333;
}

.edit_form form {
  padding: 10px;
}
</style>
