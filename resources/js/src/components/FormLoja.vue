<template>
  <div>
    <Erro :mensagem="mensagem" :codigo="codigo" v-if="feedback" />

    <b-card no-body class="mt-2">
      <b-overlay :show="loading">
        <b-form class="form">
          <b-form-group label="Nome da loja">
            <b-form-input v-model="form.nome" type="text"></b-form-input>
          </b-form-group>

          <b-form-group label="Email">
            <b-form-input v-model="form.email" type="email"></b-form-input>
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
    };
  },

  methods: {
    salvar() {
      this.feedback = false;
      this.loading = true;
      this.$http
        .post("lojas", {
          nome_loja: this.form.nome,
          email: this.form.email,
        })
        .then((res) => {
          this.loading = false;
          if (res.status === 200) {
            this.feedback = true;
            this.limparFormulario();
            if (res.data.response.data) {
              this.$store.dispatch("lojas");
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
      this.form.email = "";
    },
  },
};
</script>

<style scoped>
.form {
  padding: 30px;
}
</style>
