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
        <b-card no-body>
          <company-card></company-card>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import CompanyCard from "../components/CompanyCard";
export default {
  components: { CompanyCard },
};
</script>
