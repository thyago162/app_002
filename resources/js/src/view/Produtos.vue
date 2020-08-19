<template>
  <b-container class="mt-5">
    <b-row>
      <h4 class="ml-3">Produtos</h4>
    </b-row>
    <b-row class="mt-4">
      <b-col>
        <b-tabs>
          <b-tab title="Produtos">
            <TableProdutos />
          </b-tab>
          <b-tab title="Novo Produto">
            <FormProdutos />
          </b-tab>
        </b-tabs>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import FormProdutos from "../components/FormProdutos";
import TableProdutos from "../components/TableProdutos";
export default {
  components: { FormProdutos, TableProdutos },
};
</script>
