<template>
  <b-container class="mt-5">
    <b-row>
      <h4 class="ml-3">Lojas</h4>
    </b-row>
    <b-row class="mt-4">
      <b-col>
        <b-tabs>
          <b-tab title="Lojas">
            <TableLoja />
          </b-tab>
          <b-tab title="Nova Loja">
            <FormLoja />
          </b-tab>
        </b-tabs>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import FormLoja from "../components/FormLoja";
import TableLoja from "../components/TableLoja";
export default {
  components: { FormLoja, TableLoja },
};
</script>
