<template>
  <div class="mt-2">
    <div v-if="codigo === 403">
      <b-alert :show="true" class="mt-2" :variant="successOrFail" :dismissible="true">
        <p v-for="(msn, index) in mensagem" :key="index">{{msn}}</p>
      </b-alert>
    </div>
    <div v-else>
      <b-alert :show="true" class="mt-2" :variant="successOrFail" :dismissible="true">{{mensagem}}</b-alert>
    </div>
  </div>
</template>

<script>
export default {
  props: ["mensagem", "codigo", "feedback"],
  data() {
    return {};
  },

  computed: {
    successOrFail: function () {
      return this.codigo === 200 ? "success" : "danger";
    },
  },
};
</script>
