<template>
  <div>
    <div >
      <b-alert
        :show="true"
        class="mt-2"
        :variant="successOrFail"
        :dismissible="true"
      >{{mensagem}}</b-alert>
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
