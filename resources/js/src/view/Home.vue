<template>
  <b-container>
    <b-row class="mt-5">
      <b-col>
        <h4>
          <span>Desafio Solluti</span>
        </h4>
      </b-col>
    </b-row>

    <b-row class="mt-3">
      <b-col>
        <b-card no-body class="card">
          <div v-for="loja in lojas" :key="loja.id_loja">
              <company-card :loja="loja" class="mt-3 mb-3"></company-card>
          </div>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import CompanyCard from "../components/CompanyCard";
export default {
  components: { CompanyCard },
  created() {
    this.$store.dispatch("lojas");
  },

  computed: {
    lojas: function () {
      return this.$store.getters.lojas;
    },
  },
};
</script>

<style scoped>
    .card {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
    }
</style>
