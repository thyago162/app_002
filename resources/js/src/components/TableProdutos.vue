<template>
  <div>
    <Erro :mensagem="mensagem" :codigo="codigo" v-if="feedback" />
    <b-overlay :show="loading">
      <b-table striped hover :items="produtos" :fields="campos" class="mt-2">

        <template v-slot:cell(ativo)="row">
            <b-icon icon='circle-fill' v-if="row.item.ativo == 1" variant="success"></b-icon>
            <b-icon icon='circle-fill' v-else variant="secondary"></b-icon>
        </template>
        <template v-slot:cell(show_details)="row" hover striped>
          <b-button variant="info" size="sm" @click="row.toggleDetails" class="mr-2">
            <b-icon icon="pen" />
          </b-button>
        </template>

        <template v-slot:cell(remover)="row">
          <b-button size="sm" @click="removerproduto(row.item.id_produto)" variant="danger">
            <b-icon variant="light" icon="trash"></b-icon>
          </b-button>
        </template>

        <template v-slot:row-details="row">
          <div class="edit_form">
            <b-overlay :v-show="loading">
              <b-form inline>
                <b-input :placeholder="row.item.nome" v-model="form.nome"></b-input>
                <b-input class="ml-3" :placeholder="row.item.valor" v-model="form.valor"></b-input>
                <b-form-select class="ml-2" v-model="form.selected">
                    <b-form-select-option v-for="(loja, index) in lojas" :key="index" :value="loja.id_loja">
                        {{loja.nome_loja}}
                    </b-form-select-option>
                </b-form-select>
                <b-form-checkbox class="ml-3" v-model="form.ativo" :value="row.item.ativo" :unchecked-value="0" >
                    <span :style="{color: '#fff'}">Ativo</span>
                </b-form-checkbox>
                <b-button
                  class="ml-4"
                  variant="success"
                  @click="editarCampo(row.item.id_produto)"
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
    this.$store.dispatch("produtos");
  },

  computed: {
    produtos: function () {
      return this.$store.getters.produtos;
    },

    lojas: function () {
        return this.$store.getters.lojas
    }
  },

  data() {
    return {
      loading: false,
      feedback: false,
      mensagem: "",
      codigo: "",
      form: {
        nome: "",
        valor: "",
        selected: '',
        ativo: ''
      },
      campos: [
        { key: "nome", label: "Nome do produto", sortable: true },
        { key: "valor", label: "Valor do produto R$", sortable: true },
        {key: 'ativo', label: 'Status', sortable: true},
        { key: "show_details", label: "" },
        { key: "remover", label: "" },
      ],
    };
  },

  methods: {
    removerproduto(id) {
      this.feedback = false;
      if (confirm("Deseja remover?")) {
        axios.delete("produtos/" + id).then((res) => {
          this.loading = false;
          if (res.status == 200) {
            this.feedback = true;
            if (res.data.response.data) {
              this.$store.dispatch("produtos");
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
          this.loading = true;
        this.$http
          .put("produtos/" + id, {
            nome: this.form.nome,
            valor: this.form.valor,
            loja_id: this.form.selected,
            ativo: this.form.ativo
          })
          .then((res) => {
            this.loading = false;
            if (res.status === 200) {
              this.feedback = true;
              if (res.data.response.data) {
                this.$store.dispatch("produtos");
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
