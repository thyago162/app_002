<template>
  <div>
    <Erro :mensagem="mensagem" :codigo="codigo" v-if="feedback" />

    <b-card no-body class="mt-2">
      <b-overlay :show="loading">
        <b-form class="form">
          <b-form-group label="Nome da produto">
            <b-form-input v-model="form.nome" type="text"></b-form-input>
          </b-form-group>

          <b-form-group label="valor">
            <b-form-input v-model="form.valor" type="number" min="2" max="6"></b-form-input>
          </b-form-group>

          <b-form-group label="Loja">
            <b-form-select v-model="form.selected">
              <b-form-select-option
                v-for="(loja, index) in lojas"
                :key="index"
                :value="loja.id_loja"
              >{{loja.nome_loja}}</b-form-select-option>
            </b-form-select>
          </b-form-group>

          <b-button @click="salvar()" variant="success">Salvar</b-button>
        </b-form>
      </b-overlay>
    </b-card>
  </div>
</template>

<script>
import Erro from "./Erro";
export default {
  components: { Erro },

  created() {
    this.$store.dispatch("lojas");
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
        selected: "",
        ativo: 1
      },
    };
  },

  computed: {
    lojas: function () {
      return this.$store.getters.lojas;
    },
  },

  methods: {
    salvar() {
      this.feedback = false;
      this.loading = true;
      this.$http
        .post("produtos", {
          nome: this.form.nome,
          valor: this.form.valor,
          loja_id: this.form.selected,
          ativo:  this.form.ativo
        })
        .then((res) => {
          this.loading = false;
          if (res.status === 200) {
            this.feedback = true;
            this.limparFormulario();
            if (res.data.response.data) {
              this.$store.dispatch("produtos");
              this.mensagem = "Item adicionado com sucesso!";
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
    },

    limparFormulario() {
      this.form.nome = "";
      this.form.valor = "";
    },
  },
};
</script>

<style scoped>
.form {
  padding: 30px;
}
</style>
